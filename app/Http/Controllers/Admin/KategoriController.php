<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Aktifitasadmin;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kategori Buku';
        $user = User::whereId(auth()->user()->id)->first();
        $kategori = Kategori::latest()->filter(request(['q']))->paginate(10)->withQueryString();
        $buku = Buku::all();
        return view('backend.buku.kategori', compact('title', 'user', 'kategori', 'buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message =[
            'required' => 'Kategori belum diisi',
            'unique' => 'Kategori sudah ada',
            'max' => 'Kategori terlalu panjang'
        ];

        $request->validate([
            'kategori' => 'required|max:15|unique:kategoris'
        ], $message);

        Kategori::create([
            'kategori' => $request->kategori
        ]);
        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-book-open', 
            'backgroud' => 'bg-success',
            'notifikasi' => Auth()->user()->nama. ' membuat kategori ' .$request->kategori,
        ]);
        return back()->with([
            'alert' => 'success',
            'pesan' => 'Kategori berhasil ditambahkan',
            'color' => 'green'
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
         $message =[
            'required' => 'Kategori belum diisi',
            'unique' => 'Kategori sudah ada',
            'max' => 'Kategori terlalu panjang'
        ];

        $request->validate([
            'kategori' => 'required|max:15|unique:kategoris,kategori,' .$id,
        ], $message);

        Kategori::find($id)->update([
            'kategori' => $request->kategori,
        ]);
        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-book-open', 
            'backgroud' => 'bg-secondary',
            'notifikasi' => Auth()->user()->nama. ' mengahapus kategori ' .$request->kategori,
        ]);
        return back()->with([
            'alert' => 'success',
            'pesan' => 'Kategori berhasil diedit',
            'color' => 'green'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete($id);
        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-book-open', 
            'backgroud' => 'bg-danger',
            'notifikasi' => Auth()->user()->nama. ' mengahapus kategori ' .$kategori->kategori,
        ]);
        return back()->with([
            'alert' => 'success',
            'pesan' => 'Kategori berhasil dihapus',
            'color' => 'green'
        ]);
    }
}
