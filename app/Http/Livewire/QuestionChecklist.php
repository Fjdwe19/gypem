<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Question;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class QuestionChecklist extends Component
{
   use WithPagination; // Menggunakan trait WithPagination untuk mempermudah paginasi
protected $paginationTheme = 'bootstrap'; // Tema paginasi yang digunakan adalah 'bootstrap'
public $q = null; // Properti untuk pencarian pertanyaan
public $p = null; // Properti untuk pencarian mata pelajaran
public $selectedQuestion = []; // Array untuk menyimpan ID pertanyaan yang dipilih
public $question_list = []; // Array untuk daftar pertanyaan

public function mount($selectedExam = null)
{
    if (is_null($selectedExam)) { // Memeriksa apakah ujian yang dipilih null
        $this->selectedQuestion = []; // Jika ya, mengatur array pertanyaan yang dipilih menjadi kosong
    } else {
        $this->selectedQuestion = Exam::findOrFail($selectedExam)->questions()->pluck('question_id')->toArray(); // Jika tidak, mengambil pertanyaan dari ujian yang dipilih
    }
}

public function deselectQuestion($questionId)
{
    if (($key = array_search($questionId, $this->selectedQuestion)) !== false) { // Mencari key dari pertanyaan yang akan diseleksi
        unset($this->selectedQuestion[$key]); // Menghapus pertanyaan dari array pertanyaan yang dipilih
    }
}

public function updatedSelectedQuestion()
{
    $this->dispatchBrowserEvent('question-updated', ['selectedQuestion' => $this->selectedQuestion]); // Mengirim event ke browser saat pertanyaan yang dipilih diperbarui
}

public function render()
{
    if (empty($this->selectedQuestion)) { // Memeriksa apakah tidak ada pertanyaan yang dipilih
        return view('livewire.question-checklist', [ // Jika tidak ada, tampilkan semua pertanyaan
            'questions' => Question::latest()
                            ->when($this->q != null, function($questions) { // Filter berdasarkan pencarian pertanyaan
                                        $questions = $questions->where('detail', 'like', '%'. $this->q . '%');})
                            ->when($this->p != null, function($questions) { // Filter berdasarkan pencarian mata pelajaran
                                $questions = $questions->whereHas('subject', function (Builder $query) {
                                    $query->where('name', 'like', '%'. $this->p . '%');
                                })->get();
                                })
                            ->paginate(5),
            'subject' => new Subject()
            ]);
    } else { // Jika ada pertanyaan yang dipilih, tampilkan semua pertanyaan kecuali yang dipilih
        return view('livewire.question-checklist', [
            'questions' => Question::latest()
                            ->when($this->q != null, function($questions) {
                                        $questions = $questions->where('detail', 'like', '%'. $this->q . '%');})
                            ->when($this->p != null, function($questions) {
                                $questions = $questions->whereHas('subject', function (Builder $query) {
                                    $query->where('name', 'like', '%'. $this->p . '%');
                                })->get();
                                })->whereNotIn('id', $this->selectedQuestion) // Menghindari pertanyaan yang sudah dipilih
                            ->paginate(5),
            'questionsAll' => Question::latest()->whereIn('id', $this->selectedQuestion)->get(), // Menampilkan semua pertanyaan yang dipilih
            'subject' => new Subject()
            ]);
        }   
        
        // dd($this->questions);
    }
}
