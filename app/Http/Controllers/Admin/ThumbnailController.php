<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ThumbnailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Thumbnail';
        $user = User::whereId(auth()->user()->id)->first();
        $thumbnail = Thumbnail::latest()->get();
        return view('backend.thumbnail.thumbnail', compact('title', 'user', 'thumbnail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Thumbnail';
        $user = User::whereId(auth()->user()->id)->first();
        return view('backend.thumbnail.tambah-thumbnail', compact('title', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Gambar wajib diisi!',
            'max' => 'Gambar terlalu besar silahkan dikompress!',
            'file' => ':Inputan bukan gambar!'
        ];
        $request->validate([
            'gambar' => 'required|image|file|max:2004'
        ], $messages);

        Thumbnail::create([
            'link' => $request->link,
            'gambar' => $request->file('gambar')->store('upload/thumbnail')
        ]);

        return redirect('admin/thumbnail')->with(['alert' => 'success',
                                                  'pesan' => 'Thumbnail berhasil ditambahkan'                     
                                                ]);;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambar = Thumbnail::findorFail($id);
        if($gambar->gambar){
            Storage::delete($gambar->gambar);
        }
        Thumbnail::destroy($id);
        return redirect('admin/thumbnail')->with(['alert' => 'success',
                                                  'pesan' => 'Thumbnail berhasil dihapus'                     
                                                ]);
    }
}
