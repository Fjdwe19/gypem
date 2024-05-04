<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Constructor method untuk menginisialisasi controller.
     *
     * @return void
     */
    public function __construct()
    {
        // Terapkan middleware untuk membatasi akses berdasarkan izin
        $this->middleware(['permission:users.index|users.create|users.edit|users.delete']);
    }

    /**
     * Tampilkan daftar sumber daya (resource).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil data pengguna terbaru dengan filter pencarian opsional dan hasil dipaginasi
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        // Render view dengan data pengguna yang dipaginasi
        return view('users.index', compact('users'));
    }

    /**
     * Tampilkan formulir untuk membuat sumber daya baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil peran (role) terbaru dan render view untuk membuat pengguna baru dengan data peran
        $roles = Role::latest()->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Simpan sumber daya yang baru dibuat ke penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input pengguna
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed'
        ]);

        // Buat catatan pengguna baru di database
        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password'))
        ]);

        // Tentukan peran untuk pengguna yang baru dibuat
        $user->assignRole($request->input('role'));

        // Redirect dengan pesan sukses atau error berdasarkan hasil operasi
        if($user){
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Tampilkan formulir untuk mengedit sumber daya yang ditentukan.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Ambil peran terbaru dan render view untuk mengedit pengguna dengan data pengguna dan peran
        $roles = Role::latest()->get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Perbarui sumber daya yang ditentukan di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Validasi input pengguna
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$user->id
        ]);

        // Temukan pengguna berdasarkan id
        $user = User::findOrFail($user->id);

        // Perbarui informasi pengguna
        if($request->input('password') == "") {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email')
            ]);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password'))
            ]);
        }

        // Tentukan peran untuk pengguna yang diperbarui
        $user->syncRoles($request->input('role'));

        // Redirect dengan pesan sukses atau error berdasarkan hasil operasi
        if($user){
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Hapus sumber daya yang ditentukan dari penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan pengguna berdasarkan id dan hapus
        $user = User::findOrFail($id);
        $user->delete();

        // Kembalikan respons JSON yang menunjukkan keberhasilan atau kegagalan
        if($user){
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
