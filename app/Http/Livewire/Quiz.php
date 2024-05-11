<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Models\User;
use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use Livewire\Component;
use App\Models\Document;
use App\Models\Question;
use Livewire\WithPagination;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Builder;

class Quiz extends Component
{
    use WithPagination; // Menggunakan trait WithPagination untuk mempermudah paginasi
protected $paginationTheme = 'bootstrap'; // Tema paginasi yang digunakan adalah 'bootstrap'
public $exam_id; // ID ujian
public $user_id; // ID pengguna
public $selectedAnswers = []; // Array untuk menyimpan jawaban yang dipilih oleh pengguna
public $total_question; // Jumlah total pertanyaan pada ujian
protected $listeners = ['endTimer' => 'submitAnswers']; // Mendengarkan event 'endTimer' yang dipancarkan oleh komponen lain

public function mount($id)
{
    $this->exam_id = $id; // Menginisialisasi ID ujian saat komponen dipasang
}

public function questions()
{
    $exam = Exam::findOrFail($this->exam_id); // Mengambil data ujian berdasarkan ID
    $exam_questions = $exam->questions; // Mengambil daftar pertanyaan pada ujian
    $this->total_question = $exam_questions->count(); // Menghitung jumlah total pertanyaan pada ujian

    if($this->total_question >= $exam->total_question) { // Memeriksa jika jumlah pertanyaan cukup untuk ujian
        $questions = $exam->questions()->take($exam->total_question)->paginate(1); // Mengambil pertanyaan sesuai jumlah total pertanyaan ujian
    } elseif($this->total_question < $exam->total_question ) { // Memeriksa jika jumlah pertanyaan kurang dari total pertanyaan ujian
        $questions = $exam->questions()->take($this->total_question)->paginate(1); // Mengambil pertanyaan sesuai jumlah total pertanyaan yang tersedia
    } 
    return $questions; // Mengembalikan daftar pertanyaan untuk ditampilkan
}

public function answers($questionId, $option)
{
    $this->selectedAnswers[$questionId] = $questionId.'-'.$option; // Memilih jawaban untuk pertanyaan tertentu
}

public function submitAnswers()
{
    if(!empty($this->selectedAnswers)) // Memeriksa jika ada jawaban yang dipilih
    {
        $score = 0; // Nilai awal skor
        foreach($this->selectedAnswers as $key => $value) // Melakukan iterasi untuk setiap jawaban yang dipilih
        {
            $userAnswer = ""; // Inisialisasi jawaban pengguna
            $rightAnswer = Question::findOrFail($key)->answer; // Mengambil jawaban yang benar dari pertanyaan
            $userAnswer = substr($value, strpos($value,'-')+1); // Mendapatkan jawaban yang dipilih oleh pengguna
            $bobot = 100 / $this->total_question; // Menghitung bobot untuk setiap pertanyaan
            if($userAnswer == $rightAnswer){ // Memeriksa jika jawaban pengguna benar
                $score = $score + $bobot; // Menambah skor jika jawaban benar
            }
        }
    }else{
        $score = 0; // Jika tidak ada jawaban yang dipilih, skor tetap 0
    }
    
    $selectedAnswers_str = json_encode($this->selectedAnswers); // Mengubah array jawaban yang dipilih menjadi string JSON
    $this->user_id = Auth()->id(); // Mengambil ID pengguna yang sedang login
    $user = User::findOrFail($this->user_id); // Mengambil data pengguna berdasarkan ID
    $user_exam = $user->whereHas('exams', function (Builder $query) { // Mengecek apakah pengguna sudah melakukan ujian sebelumnya
        $query->where('exam_id',$this->exam_id)->where('user_id',$this->user_id);
    })->count();
    if($user_exam == 0) // Jika belum melakukan ujian sebelumnya
    {
        $user->exams()->attach($this->exam_id, ['history_answer' => $selectedAnswers_str, 'score' => $score]); // Menyimpan hasil ujian baru pengguna
    } else{ // Jika sudah melakukan ujian sebelumnya
        $user->exams()->updateExistingPivot($this->exam_id, ['history_answer' => $selectedAnswers_str, 'score' => $score]); // Memperbarui hasil ujian pengguna
    }
    
    return redirect()->route('exams.result', [$score, $this->user_id, $this->exam_id]); // Mengarahkan pengguna ke halaman hasil ujian
}

public function render()
{
    return view('livewire.quiz', [ // Menampilkan halaman ujian dengan data yang diperlukan
        'exam'      => Exam::findOrFail($this->exam_id), // Data ujian
        'questions' => $this->questions(), // Daftar pertanyaan
        'video'     => new Video(), // Objek video
        'audio'     => new Audio(), // Objek audio
        'document'  => new Document(), // Objek dokumen
        'image'     => new Image() // Objek gambar
    ]);
}

}
