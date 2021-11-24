<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailBukuController extends Controller
{
    public function index($kategori,$buku)
    {
        $buku = Buku::with(['kategori'])->where(['slug'=>$buku, 'status' =>'publish'])->first();

        if(Auth::guard('anggota')->user()){
            $pinjam = Pinjaman::where(['email' => Auth::guard('anggota')->user()->email, 'id_anggota' => Auth::guard('anggota')->user()->id_anggota, 'buku_id' => $buku->id])->get();
        }else {
            $pinjam = null;
        }

        if(!$buku){
            return abort(404);
        }else{
            Buku::findOrFail($buku->id)->update(['views'=> $buku->views+1]);
        }
        $title = $buku->judul_buku;
        $bukupopuler = Buku::with(['kategori'])->where(['status' => 'Publish'])->orderbydesc('views')->latest()->limit(5)->get();
        return view('detail-buku', compact('title','buku', 'bukupopuler', 'pinjam'));
    }
}
