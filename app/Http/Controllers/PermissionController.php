<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        // Menerapkan middleware untuk izin akses pada indeks izin
        $this->middleware(['permission:permissions.index']);
    } 

    /**
     * Menampilkan daftar izin.
     *
     * @return void
     */
    public function index()
    {
        // Mengambil daftar izin terbaru, jika ada pencarian, melakukan filter berdasarkan nama
        $permissions = Permission::latest()->when(request()->q, function($permissions) {
            $permissions = $permissions->where('name', 'like', '%'. request()->q . '%');
        })->paginate(5);

        // Mengirimkan data izin ke tampilan indeks izin
        return view('permissions.index', compact('permissions'));
    }
}
