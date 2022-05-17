<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $title = request('q');
        $kat = Kategori::with(['buku'])->latest()->get();
        $bukupopuler = Buku::with(['kategori'])->where(['status' => 'Publish'])->orderByDesc('views');
        $buku = Buku::latest()->filter(request(['kategori','q']))->where(['status' => 'Publish'])->get();
        $kategori = Kategori::where(['kategori'=>request('kategori')])->first();
        if(request('kategori')){
            $buku = Buku::latest()->filter(request(['kategori','q']))->where(['status' => 'Publish', 'kategori_id'=>$kategori->id])->get();
        }
        return view('search', compact('title','kat', 'bukupopuler', 'buku'));
    }
}
