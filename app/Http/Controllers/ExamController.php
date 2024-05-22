<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\User;
use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use App\Models\Subject;
use App\Models\Document;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class ExamController extends Controller
{
     /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        // Menerapkan middleware untuk izin akses pada indeks, membuat, mengedit, dan menghapus ujian
        $this->middleware(['permission:exams.index|exams.create|exams.edit|exams.delete']);
    }

    /**
     * Menampilkan daftar ujian.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mendapatkan pengguna saat ini
        $currentUser = User::findOrFail(Auth()->id());
        
        // Logika untuk menampilkan daftar ujian sesuai peran pengguna
        if($currentUser->hasRole('admin')){
            // Jika pengguna adalah admin, tampilkan semua ujian
            $exams = Exam::latest()->when(request()->q, function($exams) {
                $exams = $exams->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);
        }elseif($currentUser->hasRole('student')){
            // Jika pengguna adalah siswa, tampilkan ujian yang mereka ikuti
            $exams = Exam::whereHas('users', function (Builder $query) {
                $query->where('user_id', Auth()->id());
            })->paginate(10);
        }elseif($currentUser->hasRole('teacher')){
            // Jika pengguna adalah guru, tampilkan ujian yang mereka buat
            $exams = Exam::where('created_by', Auth()->id())->latest()->when(request()->q, function($exams) {
                $exams = $exams->where('created_by', Auth()->id())->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);
        }
        
        $user = new User();

        // Mengirimkan data ujian ke tampilan indeks ujian
        return view('exams.index', compact('exams','user'));
    }

    /**
     * Menampilkan formulir untuk membuat ujian baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Menampilkan tampilan pembuatan ujian baru
        return view('exams.create');
    }

    /**
     * Menyimpan ujian baru ke penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'name'          => 'required',
            'time'          => 'required',
            'total_question'=> 'required',
            'start'         => 'required',
            'end'           => 'required'
        ]);

        // Simpan informasi ujian ke database
        $exam = Exam::create([
            'name'          => $request->input('name'),
            'time'          => $request->input('time'),
            'total_question'=> $request->input('total_question'),
            'status'        => 'Ready',
            'start'         => $request->input('start'),
            'end'           => $request->input('end'),
            'created_by'    => Auth()->id()
        ]);

        // Sinkronkan pertanyaan ujian dengan ujian
        $exam->questions()->sync($request->input('questions'));

        // Redirect dengan pesan sukses atau error
        if($exam){
            return redirect()->route('exams.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('exams.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Menampilkan formulir untuk mengedit ujian tertentu.
     *
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(exam $exam)
    {
        // Mendapatkan pertanyaan untuk ujian tertentu
        $questions = $exam->questions()->where('exam_id', $exam->id)->get();
        
        // Menampilkan tampilan pengeditan ujian
        return view('exams.edit', compact('exam', 'questions'));
    }

    /**
     * Memperbarui informasi ujian tertentu di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, exam $exam)
    {
        // Validasi input
        $this->validate($request, [
            'name'          => 'required',
            'time'          => 'required',
            'total_question'=> 'required',
            'start'         => 'required',
            'end'           => 'required'
        ]);

        // Perbarui informasi ujian di database
        $exam->update([
            'name'          => $request->input('name'),
            'time'          => $request->input('time'),
            'total_question'=> $request->input('total_question'),
            'start'         => $request->input('start'),
            'end'           => $request->input('end'),
            'created_by'    => Auth()->id()
        ]);

        // Sinkronkan pertanyaan ujian dengan ujian
        $exam->questions()->sync($request->input('questions'));

        // Redirect dengan pesan sukses atau error
        if($exam){
            return redirect()->route('exams.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('exams.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Menampilkan detail ujian tertentu.
     *
     * @param  Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(exam $exam)
    {
        // Mendapatkan pertanyaan untuk ujian tertentu
        $questions = $exam->questions()->where('exam_id', $exam->id)->get();
        
        // Menampilkan tampilan detail ujian
        return view('exams.show', compact('exam', 'questions'));
    }

    /**
     * Menghapus ujian tertentu dari penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan dan hapus ujian berdasarkan ID
        $exam = Exam::findOrFail($id);
 
    }

    public function start($id)
    {
        $exam = Exam::findOrFail($id);
        $exam_questions = $exam->questions;

        if ($exam_questions->count() == 0) {
            return back()->with(['error' => 'Belum ada Pertanyaan']);
        }
        return view('exams.start', compact('id'));
    }

    public function result($score, $userId, $examId)
    {
        $user = User::findOrFail($userId);
        $exam = Exam::findOrFail($examId);
        return view('exams.result', compact('score', 'user', 'exam'));
    }

    public function student($id)
    {
        $exam = Exam::findOrFail($id);
        return view('exams.student', compact('exam'));
    }

    public function assign(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $exam->users()->sync($request->input('students'));

        return redirect('/exams');

    }

    public function review($userId, $examId)
    {
        return view('exams.review', compact('userId', 'examId'));
    }
}