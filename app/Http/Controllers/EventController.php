<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        // Menerapkan middleware untuk izin akses pada indeks, membuat, dan menghapus gambar
        $this->middleware(['permission:events.index|events.create|events.delete']);
    }

    /**
     * Menampilkan daftar gambar.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('images.index', compact('images'));
    }

    /**
     * Menyimpan gambar baru ke penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'title'     => 'required',
            'image'     => 'required|mimes:jpg,bmp,png',
            'caption'   => 'required'
        ]);

        // Unggah gambar
        $image = $request->file('image');
        $image->storeAs('public/images', $image->hashName());

        // Simpan informasi gambar ke database
        $image = Image::create([
            'title'     => $request->input('title'),
            'link'     => $image->hashName(),
            'caption'   => $request->input('caption')
        ]);

        // Redirect dengan pesan sukses atau error
        if($image){
            return redirect()->route('images.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('images.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Menghapus gambar tertentu dari penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan dan hapus gambar berdasarkan ID
        $image = Image::findOrFail($id);
        $link= Storage::disk('local')->delete('public/images/'.$image->link);
        $image->delete();

        // Memberikan respons JSON untuk status penghapusan
        if($image){
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
