<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        // Menerapkan middleware untuk izin akses pada indeks, membuat, dan menghapus dokumen
        $this->middleware(['permission:documents.index|documents.create|documents.delete']);
    }

    /**
     * Menampilkan daftar dokumen.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil daftar dokumen terbaru, jika ada pencarian, melakukan filter berdasarkan judul
        $documents = Document::latest()->when(request()->q, function($documents) {
            $documents = $documents->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        // Mengirimkan data dokumen ke tampilan indeks dokumen
        return view('documents.index', compact('documents'));
    }

    /**
     * Menyimpan dokumen baru ke penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'title'     => 'required',
            'document'     => 'required|mimes:doc,docx,pdf',
            'caption'   => 'required'
        ]);

        // Unggah dokumen
        $document = $request->file('document');
        $document->storeAs('public/documents', $document->hashName());

        // Simpan informasi dokumen ke database
        $document = Document::create([
            'title'     => $request->input('title'),
            'link'     => $document->hashName(),
            'caption'   => $request->input('caption')
        ]);

        // Redirect dengan pesan sukses atau error
        if($document){
            return redirect()->route('documents.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('documents.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Menghapus dokumen tertentu dari penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan dan hapus dokumen berdasarkan ID
        $document = Document::findOrFail($id);
        $link= Storage::disk('local')->delete('public/documents/'.$document->link);
        $document->delete();

        // Memberikan respons JSON untuk status penghapusan
        if($document){
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
