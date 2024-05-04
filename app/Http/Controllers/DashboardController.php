<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Mengambil semua ujian yang terkait dengan pengguna yang saat ini masuk
        $exams = Exam::whereHas('users', function (Builder $query) {
            $query->where('user_id', Auth()->id());
        })->get();
        
        // Mengirimkan data ujian ke tampilan dashboard
        return view('dashboard.index', compact('exams'));

    }
}
