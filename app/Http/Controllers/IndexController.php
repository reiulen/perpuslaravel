<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Kategori;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $title = 'E-Perpus SMKN 1 Ciamis';
        $bukupopuler = Buku::with(['kategori'])->where(['status' => 'Publish'])->orderByDesc('views')->limit(10)->get();
        $thumbnail = Thumbnail::latest()->limit(10)->get();
        $kat = Kategori::latest()->get();
        return view('index', compact('title','bukupopuler', 'kat', 'thumbnail'));
    }
    public function tampil(Kategori $kategori)
    {
        $bukukategori = $kategori->buku->load(['kategori']); 
        return view('tampil', compact('bukukategori'));
    }
    public function semuabuku(Kategori $kategori)
    {   
        $buku = Buku::with(['kategori'])->where(['status' => 'Publish'])->latest()->get(); 
        return view('buku-tampil', compact('buku'));
    }
    public function showkategori(Kategori $kategori)
    {
        $title = 'Kategori '.$kategori->kategori;
        $kat = Kategori::latest()->get();
        $buku = $kategori->buku->load(['kategori']); 
        return view('semua-buku', compact('title','kategori','kat','buku'));
    }

    public function logoutuser(Anggota $anggota)
    {
        if(!Auth::guard('anggota')->user()){
            return redirect('/');
        }
        
        $anggota = Anggota::findorfail(Auth::guard('anggota')->user()->id);
        Request()->session()->regenerateToken();
        Request()->session()->invalidate();
        $anggota->update(['aktifitas' => 'logout']);
        Auth::guard('anggota')->logout($anggota);
        return redirect('/')->with([
            'alert' => 'success',
            'title' => 'Berhasil logout'
        ]);
    }
}
