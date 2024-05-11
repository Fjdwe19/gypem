<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Models\User;
use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use Livewire\Component;
use App\Models\Document;
use Livewire\WithPagination;

class Review extends Component
{
    use WithPagination; // Menggunakan trait WithPagination untuk mempermudah paginasi
protected $paginationTheme = 'bootstrap'; // Tema paginasi yang digunakan adalah 'bootstrap'
public $user_id; // ID pengguna
public $exam_id; // ID ujian
public $selectedAnswers = []; // Array untuk menyimpan jawaban yang dipilih oleh pengguna
public $total_question; // Jumlah total pertanyaan pada ujian

public function mount($user_id, $exam_id)
{
    $this->user_id = $user_id; // Menginisialisasi ID pengguna
    $this->exam_id = $exam_id; // Menginisialisasi ID ujian
    $user = User::findOrfail($user_id); // Mengambil data pengguna berdasarkan ID
    $user_exam = $user->exams->find($exam_id); // Mengambil data ujian yang dilakukan oleh pengguna
    $answer = $user_exam->pivot->history_answer; // Mengambil jawaban yang disimpan oleh pengguna untuk ujian tertentu

    $result = json_decode($answer); // Mendekodekan string JSON jawaban menjadi array
    $this->selectedAnswers = (array)$result; // Mengkonversi objek hasil dekode menjadi array
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

public function getAnswers()
{
    // Metode untuk mendapatkan jawaban pengguna
}

public function render()
{
    return view('livewire.review', [ // Menampilkan halaman review jawaban pengguna
        'exam'      => Exam::findOrFail($this->exam_id), // Data ujian
        'questions' => $this->questions(), // Daftar pertanyaan
        'video'     => new Video(), // Objek video
        'audio'     => new Audio(), // Objek audio
        'document'  => new Document(), // Objek dokumen
        'image'     => new Image() // Objek gambar
    ]);
}

}
