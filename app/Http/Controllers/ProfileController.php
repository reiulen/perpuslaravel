<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Aktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $title = 'Profile';
        $user = Auth::guard('anggota')->user();
        return view('profil.profile', compact(['title', 'user']));
    }
    public function pinjaman()
    {
        $title = 'Pinjaman';
        $user = Auth::guard('anggota')->user();
        $pinjam = Pinjaman::where(['email' => Auth::guard('anggota')->user()->email])->filter(request(['pinjam']))->latest()->paginate(10)->withQueryString();

        return view('profil.pinjaman', compact('title','user','pinjam'));
    }
    public function ubahprofil(Request $request, Anggota $anggota)
    {
        $user = Anggota::find(Auth::guard('anggota')->user()->id);
        if(!$user){
            return abort(404);
        }

        $message = [
            'required' => 'wajib diisi!',
            'max' => 'terlalu pendek!',
            'min' => 'terlalu panjang!',
            'unique' => 'sudah tersedia!',
            'numeric' => 'bukan angka'
        ];
        
        if($request->a == 'a'){
            $request->validate([
                'nama' => 'required',
                'nis' => 'required|min:8|max:9|unique:anggotas,nis,' .$user->id,
                'jenis_kelamin' => 'required',
                'kelas' => 'required'
            ], $message);

           Anggota::find(Auth::guard('anggota')->user()->id)->update([
                'nama' => $request->nama,
                'nis' => $request->nis,
                'jenis_kelamin' => $request->jenis_kelamin,
                'kelas' => $request->kelas
           ]);

           return back()->with([
                                'alert' => 'success',
                                'title' => 'Profil berhasil di update'
           ]);
       
        }

        

        if($request->file('foto') AND $request->file('foto') != 'user.png'){
            $request->validate([
                'foto' => 'image|file|max:2024',
            ]);
            $user->update([
                'foto' => $request->file('foto')->store('upload/user')
            ]);
            Storage::delete($anggota->foto);
            return back()->with([
                                 'alert' => 'success',
                                 'title' => 'Foto profil berhasil diubah'
            ]);
        }

        return back();
    }

    public function pinjamus(Pinjaman $pinjaman)
    {

        $buku = $pinjaman->buku->load(['pinjaman']);

        Buku::find($pinjaman->buku_id)->update([
            'jumlah_buku' => $buku->jumlah_buku,+1,
            'pinjaman' => $buku->pinjaman,-1
        ]);

        Aktifitas::create([
            'user_id' => Auth::guard('anggota')->user()->id,
            'icon' => 'fas fa-book-reader',
            'background' => 'bg-danger',
            'notifikasi' => 'Anda membatakan peminjaman buku '.$buku->judul_buku,
        ]);

        Pinjaman::find($pinjaman->id)->delete($pinjaman->id);
        return back()->with([
            'alert' => 'success',
            'title' => 'Pinjaman berhasil dibatalkan'
        ]);
    }

    public function aktifitas()
    {
        $title = 'Aktifitas';
        $user = Auth::guard('anggota')->user();
        $aktifitas = Aktifitas::where(['user_id'=>Auth::guard('anggota')->user()->id])->latest()->paginate(10);
        return view('profil.aktifitas', compact(['title', 'user', 'aktifitas']));
    }

    public function hapusaktifitas(Aktifitas $aktifitas)
    {
        Aktifitas::find($aktifitas->id)->delete($aktifitas->id);
        return back()->with([
            'alert' => 'success',
            'title' => 'Notifikasi berhasil dihapus'
        ]);
    }
}
