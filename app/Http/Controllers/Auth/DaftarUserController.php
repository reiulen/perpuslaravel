<?php

namespace App\Http\Controllers\Auth;

use App\Models\Anggota;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class DaftarUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar E-Perpus';
        $kat = Kategori::latest()->get();
        return view('daftar-user', compact('title', 'kat'));
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
       $message = [
           'required' => 'harus diisi!',
           'unique' => 'sudah tersedia',
           'email' => 'tidak valid!',
           'same' => 'tidak sama!',
           'min' => 'terlalu pendek',
           'max' => 'terlalu panjang!'
       ];
       $request->validate([
           'nama' => 'required',
           'kelas' => 'required',
           'j_kelamin' => 'required',
           'nis' => 'required|unique:anggotas|max:9|min:8',
           'email' => 'required|unique:anggotas|email:rfc,dns',
           'password1' => 'min:6|max:12|min:6|required_with:password2|same:password2',
           'password2' => 'min:6'
       ], $message);

       $data = Anggota::create([
                    'id_anggota' => 'AEP'.date("yd") .Anggota::max('id')+1,
                    'foto' => 'user.png',
                    'nama' => $request->nama,
                    'kelas' => $request->kelas,
                    'nis' => $request->nis,
                    'jenis_kelamin' => $request->j_kelamin,
                    'email' => $request->email,
                    'password' => Hash::make($request->password1),
                    'aktifitas' => 'Baru daftar',
                ]);


       //verifikasi email
       event(new Registered($data));
       return redirect('/login')->with([
                    'alert'=>'success',
                    'title' => 'Anggota berhasil daftar'
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
        //
    }
}
