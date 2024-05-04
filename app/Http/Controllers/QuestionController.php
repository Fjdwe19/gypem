<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use App\Models\Subject;
use App\Models\Document;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
     /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        // Menerapkan middleware untuk izin akses pada indeks, membuat, mengedit, dan menghapus pertanyaan
        $this->middleware(['permission:questions.index|questions.create|questions.edit|questions.delete']);
    }

    /**
     * Menampilkan daftar pertanyaan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil daftar pertanyaan terbaru, jika ada pencarian, melakukan filter berdasarkan detail pertanyaan
        $questions = Question::latest()->when(request()->q, function($questions) {
            $questions = $questions->where('detail', 'like', '%'. request()->q . '%');
        })->paginate(10);

        // Membuat instance objek subjek, video, audio, gambar, dokumen, dan pengguna
        $subject = new Subject();
        $video = new Video();
        $audio = new Audio();
        $document = new Document();
        $image = new Image();
        $user = new User();

        // Mengirimkan data pertanyaan dan objek terkait ke tampilan indeks pertanyaan
        return view('questions.index', compact('questions', 'subject', 'video', 'audio', 'document', 'image', 'user'));
    }

    /**
     * Menampilkan formulir untuk membuat pertanyaan baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengambil daftar subjek, video, audio, gambar, dan dokumen terbaru
        $subjects = Subject::latest()->get();
        $videos = Video::latest()->get();
        $audios = Audio::latest()->get();
        $images = Image::latest()->get();
        $documents = Document::latest()->get();
        
        // Mengirimkan data ke tampilan membuat pertanyaan
        return view('questions.create', compact('subjects', 'videos', 'audios', 'images', 'documents'));
    }

    /**
     * Menyimpan pertanyaan baru ke penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'subject_id'  => 'required',
            'detail'      => 'required',
            'option_A'    => 'required',
            'option_B'    => 'required',
            'option_C'    => 'required',
            'option_D'    => 'required',
            'answer'      => 'required',
            'explanation' => 'required'
        ]);

        // Simpan informasi pertanyaan ke database
        $question = Question::create([
            'subject_id'    => $request->input('subject_id'),
            'detail'        => $request->input('detail'),
            'option_A'      => $request->input('option_A'),
            'option_B'      => $request->input('option_B'),
            'option_C'      => $request->input('option_C'),
            'option_D'      => $request->input('option_D'),
            'option_E'      => $request->input('option_E'),
            'video_id'      => $request->input('video_id'),
            'audio_id'      => $request->input('audio_id'),
            'image_id'      => $request->input('image_id'),
            'document_id'   => $request->input('document_id'),
            'answer'        => $request->input('answer'),
            'explanation'   => $request->input('explanation'),
            'created_by'    => Auth()->id()
        ]);

        // Redirect dengan pesan sukses atau error
        if($question){
            return redirect()->route('questions.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('questions.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Menampilkan formulir untuk mengedit pertanyaan tertentu.
     *
     * @param  Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        // Mengambil daftar subjek, video, audio, gambar, dan dokumen terbaru
        $subjects = Subject::latest()->get();
        $videos = Video::latest()->get();
        $audios = Audio::latest()->get();
        $images = Image::latest()->get();
        $documents = Document::latest()->get();
        
        // Mengirimkan data ke tampilan mengedit pertanyaan
        return view('questions.edit', compact('question', 'subjects', 'videos', 'audios', 'images', 'documents'));
    }

    /**
     * Memperbarui informasi pertanyaan tertentu di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        // Validasi input
        $this->validate($request, [
            'subject_id'  => 'required',
            'detail'      => 'required',
            'option_A'    => 'required',
            'option_B'    => 'required',
            'option_C'    => 'required',
            'option_D'    => 'required',
            'answer'      => 'required',
            'explanation' => 'required'
        ]);

        // Temukan dan perbarui informasi pertanyaan berdasarkan ID
        $question = Question::findOrFail($question->id);

        $question->update([
            'subject_id'    => $request->input('subject_id'),
            'detail'        => $request->input('detail'),
            'option_A'      => $request->input('option_A'),
            'option_B'      => $request->input('option_B'),
            'option_C'      => $request->input('option_C'),
            'option_D'      => $request->input('option_D'),
            'option_E'      => $request->input('option_E'),
            'video_id'      => $request->input('video_id'),
            'audio_id'      => $request->input('audio_id'),
            'image_id'      => $request->input('image_id'),
            'document_id'   => $request->input('document_id'),
            'answer'        => $request->input('answer'),
            'explanation'   => $request->input('explanation'),
            'created_by'    => Auth()->id()
        ]);


        if($question){
            //redirect dengan pesan sukses
            return redirect()->route('questions.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('questions.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();


        if($question){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
