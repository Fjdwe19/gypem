<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Student extends Component
{
   use WithPagination; // Menggunakan trait WithPagination untuk mempermudah paginasi
protected $paginationTheme = 'bootstrap'; // Tema paginasi yang digunakan adalah 'bootstrap'
public $q = null; // Properti untuk pencarian nama siswa
public $selectedStudent = []; // Array untuk menyimpan ID siswa yang dipilih

public function mount($selectedExam = null)
{
    if (is_null($selectedExam)) { // Memeriksa apakah ujian yang dipilih null
        $this->selectedStudent = []; // Jika ya, mengatur array siswa yang dipilih menjadi kosong
    } else {
        $this->selectedStudent = Exam::findOrFail($selectedExam)->users()->pluck('user_id')->toArray(); // Jika tidak, mengambil siswa dari ujian yang dipilih
    }
   
}

public function deselectStudent($userId)
{
    if (($key = array_search($userId, $this->selectedStudent)) !== false) { // Mencari key dari siswa yang akan diseleksi
        unset($this->selectedStudent[$key]); // Menghapus siswa dari array siswa yang dipilih
    }
}

public function render()
{
    if (empty($this->selectedStudent)) { // Memeriksa jika tidak ada siswa yang dipilih
        return view('livewire.student', [ // Jika tidak ada, tampilkan semua siswa
            'students' => User::role('student')->latest()
                            ->when($this->q != null, function($users) { // Filter berdasarkan pencarian nama siswa
                                $users = $users->role('student')->where('name', 'like', '%'. $this->p . '%');
                                })
                                ->paginate(5),
            ]);
    } else { // Jika ada siswa yang dipilih, tampilkan semua siswa kecuali yang dipilih
        return view('livewire.student', [
            'students' => User::role('student')->latest()
                            ->when($this->q != null, function($users) { // Filter berdasarkan pencarian nama siswa
                                $users = $users->role('student')->where('name', 'like', '%'. $this->p . '%');
                                })
                            ->whereNotIn('id', $this->selectedStudent) // Menghindari siswa yang sudah dipilih
                            ->paginate(5),
            'studentsAll' => User::role('student')->latest()->whereIn('id', $this->selectedStudent)->get() // Menampilkan semua siswa yang dipilih
            ]);
    }
    
}

}
