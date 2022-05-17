<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kategori;
use App\Models\Pinjaman;
use App\Models\Aktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
Use App\Models\Buku;

class PinjamBukuController extends Controller
{
    public function pinjambuku(Buku $buku)
    {
        $pinjam = Pinjaman::where(['email' => Auth::guard('anggota')->user()->email, 'id_anggota' => Auth::guard('anggota')->user()->id_anggota, 'buku_id' => $buku->id])->get();
        if($buku->jumlah_buku == 0 OR $pinjam->count()>0){
            return back();
        }
        $title = 'Pinjam Buku';
        return view('pinjam-buku', compact('title', 'buku'));
    }

    public function pinjam(Request $request, Buku $buku)
    {
        $request->validate([
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required'
        ]);

        $data = [
            'id_anggota' => Auth::guard('anggota')->user()->id_anggota,
            'nama_peminjam' => Auth::guard('anggota')->user()->nama,
            'email' => Auth::guard('anggota')->user()->email,
            'jenis_kelamin' => Auth::guard('anggota')->user()->jenis_kelamin,
            'kelas' => Auth::guard('anggota')->user()->kelas,
            'judul_buku' => $buku->judul_buku,
            'buku_id' => $buku->id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
         ];

        Aktifitas::create([
            'user_id' => Auth::guard('anggota')->user()->id,
            'icon' => 'fas fa-book-reader',
            'background' => 'bg-success',
            'notifikasi' => 'Selamat kamu berhasil meminjam buku '.$buku->judul_buku .'silahkan ambil buku di perpustakaan',
        ]);
        
        Buku::find($buku->id)->update([
            'jumlah_buku' => $buku->jumlah_buku -1,
            'pinjaman' => $buku->pinjaman +1,
        ]);

        Pinjaman::create($data);
        $pinjam = Pinjaman::where('email', Auth::guard('anggota')->user()->email)->latest()->first();
        return  Redirect::route('pinjamberhasil', [Auth::guard('anggota')->user()->email, $pinjam->id])->with([
                                                                                                                'alert' => 'success',
                                                                                                                'title' => 'Pinjaman berhasil dibuat',
                                                                                                                ]);
    }

    public function pinjamberhasil($email,$id)
    {
       $pinjam = Pinjaman::with(['buku'])->where(['email' => $email, 'id'=>$id])->first();
       if(!$pinjam){
           return abort(404);
       }
       
       $title = 'Pinjam Berhasil';
       return view('pinjamberhasil', compact('title',  'pinjam'));
    }
}
