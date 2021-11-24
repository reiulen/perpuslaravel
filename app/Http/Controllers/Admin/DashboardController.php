<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buku;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use App\Models\Aktifitasadmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $thumbnail = Thumbnail::latest()->limit(10)->get();
        $user = User::whereId(auth()->user()->id)->first();
        $petugas = User::whereRole('petugas')->get();
        $buku = Buku::orderByDesc('views');
        $anggota = Anggota::latest()->get();
        $pinjaman = Pinjaman::latest();
        return view('backend.dashboard', compact('title', 'user', 'petugas', 'thumbnail', 'buku', 'anggota', 'pinjaman'));
    }
    public function logout()
    {
        Request()->session()->regenerateToken();
        Request()->session()->invalidate();
        User::find(auth()->user()->id)->update(['aktifitas' => 'Logout']);
        Auth::logout();
        return redirect('/login-admin');
    }

    public function anggota()
    {
        $title = 'Data Anggota';
        $user = User::findorFail(auth()->user()->id);
        $jumlah = Anggota::get();
        if(request('status')){
            $anggota = Anggota::where('status', request('status'))->Filter(request(['q']))->latest()->paginate(10)->withQueryString();;
        }else {
            $anggota = Anggota::Filter(request(['q']))->latest()->paginate(10)->withQueryString();;
        }
        return view('backend.anggota', compact('title', 'user', 'anggota', 'jumlah'));
    }
    public function delete(Anggota $anggota)
    {
        $anggota = Anggota::find($anggota->id);
        $anggota->delete($anggota->id);
        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-user', 
            'backgroud' => 'bg-danger',
            'notifikasi' => Auth()->user()->nama. ' mengahapus anggota ' .$anggota->id_anggota  .$anggota->nama,
        ]);
        return back()->with([
            'alert' => 'success',
            'pesan' => 'Anggota berhasil dihapus',
            'color' => 'green'
        ]);
    }
    public function update(Anggota $anggota, Request $request)
    {
        $anggota = Anggota::find($anggota->id);
        $anggota->update([
            'status' => $request->status,
        ]);
        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-user', 
            'backgroud' => 'bg-primary',
            'notifikasi' => Auth()->user()->nama. ' mengubah status anggota ' .$anggota->id_anggota   .$anggota->nama. ' menjadi ' .$request->status,
        ]);
        return back()->with([
            'alert' => 'success',
            'pesan' => 'Status anggota berhasil diedit',
            'color' => 'green'
        ]);
    }
}
