<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        // Menerapkan middleware untuk izin akses pada indeks, membuat, dan menghapus audio
        $this->middleware(['permission:audios.index|audios.create|audios.delete']);
    }

    /**
     * Menampilkan daftar sumber suara.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil daftar audio terbaru, jika ada pencarian, melakukan filter berdasarkan judul
        $audios = Audio::latest()->when(request()->q, function($audios) {
            $audios = $audios->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('audios.index', compact('audios'));
    }

    /**
     * Menyimpan sumber suara baru ke penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'title'     => 'required',
            'audio'     => 'required|mimes:mp3,wav',
            'caption'   => 'required'
        ]);

        // Unggah audio
        $audio = $request->file('audio');
        $audio->storeAs('public/audios', $audio->hashName());

        // Simpan informasi audio ke database
        $audio = Audio::create([
            'title'     => $request->input('title'),
            'link'     => $audio->hashName(),
            'caption'   => $request->input('caption')
        ]);

        // Redirect dengan pesan sukses atau error
        if($audio){
            return redirect()->route('audios.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('audios.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Menghapus sumber suara dari penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan dan hapus audio berdasarkan ID
        $audio = Audio::findOrFail($id);
        $link= Storage::disk('local')->delete('public/audios/'.$audio->link);
        $audio->delete();

        // Memberikan respons JSON untuk status penghapusan
        if($audio){
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
