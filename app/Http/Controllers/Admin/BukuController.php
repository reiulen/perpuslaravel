<?php

namespace App\Http\Controllers\admin;

use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Pinjaman;
use App\Models\Aktifitasadmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Buku';
        $jumlah = Buku::all();
        $user = User::whereId(auth()->user()->id)->first();

        if(request('status')){
            $buku = Buku::with('kategori')->where('status', request('status'))->latest()->filter(request(['q']))->paginate(10)->withQueryString();;
        }else{
            $buku = Buku::with('kategori')->latest()->filter(request(['q']))->paginate(10)->withQueryString();;
        }
        $pinjaman = Pinjaman::with('buku')->latest()->get();
        return view('backend.buku.buku', compact('title', 'user', 'buku', 'pinjaman', 'jumlah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Buku';
        $user = User::whereId(auth()->user()->id)->first();
        $kategori = Kategori::latest()->get();
        return view('backend.buku.tambah-buku', compact('title', 'user', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => 'harus diisi!',
            'image' => 'Bukan gambar!',
            'file' => 'Inputan tidak diizinkan!',
            'max' => 'Ukuran gambar terlalu besar!',
        ];
        $request->validate([
            'judul_buku' => 'required',
            'gambar_buku' => 'image|file|max:2024',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'penerbit' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'status' => 'required'
        ], $message);

        if($request->gambar_buku){
            $gambar =$request->file('gambar_buku')->store('upload/sampul/');
        }else{
            $gambar = 'gambar.jpg';
        }

        Buku::create([
            'judul_buku' => $request->judul_buku,
            'slug' => strtolower(str_replace(" ", "-", $request->judul_buku)),
            'pengarang' => $request->pengarang,
            'jumlah_buku' => $request->jumlah_buku,
            'deskripsi' => $request->deskripsi,
            'tahun_terbit' => $request->tahun_terbit,
            'penerbit' => $request->penerbit,
            'isbn' => $request->isbn,
            'kategori_id' => $request->kategori_id,
            'gambar_buku' => $gambar,
            'status' => $request->status
        ]);

        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-book', 
            'backgroud' => 'bg-success',
            'notifikasi' => Auth()->user()->nama.  ' menambahkan buku ' .$request->judul_buku,
        ]);

        return redirect('admin/buku')->with(['alert' => 'success',
                                             'pesan' => 'Buku berhasil ditambahkan'                     
                                            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Buku::findorFail($id);
        $title = 'Edit Buku';
        $user = User::whereId(auth()->user()->id)->first();
        $kategori = Kategori::latest()->get();
        return view('backend.buku.edit-buku', compact('title', 'user', 'kategori', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $message = [
            'required' => 'harus diisi!',
            'image' => 'Bukan gambar!',
            'file' => 'Inputan tidak diizinkan!',
            'max' => 'Ukuran gambar terlalu besar!',
        ];
        $request->validate([
            'judul_buku' => 'required',
            'gambar_buku' => 'image|file|max:2024',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'penerbit' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'status' => 'required'
        ], $message);

        $buku = Buku::findorFail($id);

        $gambar = $buku->gambar_buku;

        if($request->gambar_buku){
            $gambar = $request->file('gambar_buku')->store('upload/sampul');
        }

        if($request->gambar_buku AND $buku->gambar_buku != 'gambar.jpg'){
            Storage::delete($buku->gambar_buku);
        }

        $data = [
            'judul_buku' => $request->judul_buku,
            'slug' => strtolower(str_replace(" ", "-", $request->judul_buku)),
            'pengarang' => $request->pengarang,
            'jumlah_buku' => $request->jumlah_buku,
            'deskripsi' => $request->deskripsi,
            'tahun_terbit' => $request->tahun_terbit,
            'penerbit' => $request->penerbit,
            'isbn' => $request->isbn,
            'kategori_id' => $request->kategori_id,
            'gambar_buku' => $gambar,
            'status' => $request->status
        ];
        $buku->update($data);
        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-book', 
            'backgroud' => 'bg-secondary',
            'notifikasi' => Auth()->user()->nama. ' mengedit buku ' .$request->judul_buku,
        ]);
        return redirect('admin/buku')->with(['alert' => 'success',
                                             'pesan' => 'Buku berhasil diedit'                     
                                            ]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambar = Buku::findorFail($id);
        if($gambar->gambar_buku != 'gambar.jpg'){
            Storage::delete($gambar->gambar_buku);
        }
        Buku::destroy($id);
        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-edit', 
            'backgroud' => 'bg-danger',
            'notifikasi' => Auth()->user()->nama. ' mengahapus buku ' .$gambar->judul_buku,
        ]);
        return redirect('admin/buku')->with(['alert' => 'success',
                                              'pesan' => 'Buku berhasil dihapus'                     
                                            ]);
    }
}
