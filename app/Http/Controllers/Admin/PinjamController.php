<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buku;
use App\Models\User;
use App\Models\Pinjaman;
use App\Models\Aktifitas;
use App\Models\Aktifitasadmin;
use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Pinjaman';
        $user = User::whereId(auth()->user()->id)->first();
        $pinjam = Pinjaman::latest()->filter(request(['pinjam']))->paginate(10)->withQueryString();
        if(request('status')){
            $pinjam = Pinjaman::where(['status' => request('status')])->filter(request(['pinjam']))->latest()->paginate(10)->withQueryString();
        }

        $jumlah = Pinjaman::get();
        return view('backend.pinjam.pinjam', compact('title', 'user', 'pinjam', 'jumlah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Pinjaman';
        $user = User::whereId(auth()->user()->id)->first();

        $anggota = Anggota::orderByDESC('nama')->get();
        $buku = Buku::orderByDESC('judul_buku')->get();
        return view('backend.pinjam.tambahpinjaman', compact('title', 'user', 'anggota', 'buku'));
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
            'required' => 'harus diisi!'
        ];
        
        if(request('jenis_pinjaman')=='anggota'){
            $request->validate([
            'jenis_pinjaman' => 'required',
            'id_anggota' => 'required',
            'judul_buku' => 'required',
            ], $message);

            $anggota = Anggota::find($request->id_anggota);
            $buku = Buku::find($request->judul_buku);
            $buku->update([
                'jumlah_buku' => $buku->jumlah_buku, -1,
                'pinjaman' => $buku->pinjaman, +1,
            ]);

             Aktifitas::create([
                'user_id' => $anggota->id,
                'icon' => 'fas fa-book-reader',
                'background' => 'bg-success',
                'notifikasi' => 'Selamat kamu berhasil meminjam buku '.$buku->judul_buku .'silahkan ambil buku di perpustakaan',
            ]);
            Aktifitasadmin::create([
                'user_id' => Auth()->user()->id,
                'icon' => 'fas fa-book-reader', 
                'backgroud' => 'bg-success',
                'notifikasi' => Auth()->user()->nama. ' menambahkan pinjaman ' .$buku->judu_buku,
            ]);

            Pinjaman::create([
                'id_anggota' => $anggota->id_anggota,
                'nama_peminjam' => $anggota->nama,
                'email' => $anggota->email,
                'jenis_kelamin' => $anggota->jenis_kelamin,
                'kelas' => $anggota->kelas,
                'judul_buku' => $buku->judul_buku,
                'buku_id' => $buku->id,
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
                'status' => $request->status,
            ]);

            return redirect('admin/pinjam')->with([
                'alert' => 'success',
                'pesan' => 'Pinjaman berhasil ditambahkan',
                'color' => 'green'
            ]);
        }elseif(request('jenis_pinjaman')=='bukananggota'){
            $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_pinjaman' => 'required',
            'judul_buku' => 'required',
            ], $message);

            $buku = Buku::find($request->judul_buku);
            $buku->update([
                'jumlah_buku' => $buku->jumlah_buku, -1,
                'pinjaman' => $buku->pinjaman, +1,
            ]);

            Pinjaman::create([
                'id_anggota' => 'Bukan Anggota',
                'nama_peminjam' => $request->nama,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'kelas' => $request->kelas,
                'judul_buku' => $buku->judul_buku,
                'buku_id' => $buku->id,
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
                'status' => $request->status,
            ]);
            Aktifitasadmin::create([
                'user_id' => Auth()->user()->id,
                'icon' => 'fas fa-book-reader', 
                'backgroud' => 'bg-success',
                'notifikasi' => Auth()->user()->nama. ' menambahkan pinjaman ' .$buku->judu_buku,
            ]);
            return redirect('admin/pinjam')->with([
                'alert' => 'success',
                'pesan' => 'Pinjaman berhasil ditambahkan',
                'color' => 'green'
            ]);
        }else{
            return back();
        }

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
        $pinjam = Pinjaman::find($id);
        $pinjam->update([
            'status' => $request->status
        ]);
        if(request('anggota')){
            $user = Anggota::where('id_anggota',$pinjam->id_anggota)->first();
            Aktifitas::create([
                'user_id' => $user->id,
                'icon' => 'fas fa-book-reader',
                'background' => 'bg-success',
                'notifikasi' => 'Pinjaman buku'.$pinjam->judul_buku. '&nbsp;'  .$request->status,
            ]);
        }

         Aktifitasadmin::create([
                'user_id' => Auth()->user()->id,
                'icon' => 'fas fa-book-reader', 
                'backgroud' => 'bg-secondary',
                'notifikasi' => Auth()->user()->nama.' mengedit pinjaman ' .$pinjam->judu_buku. ' menjadi ' .$request->status,
        ]);

        return back()->with([
            'alert' => 'success',
            'pesan' => 'Pinjaman berhasil diedit',
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
        $pinjaman = Pinjaman::find($id);
        $buku = Buku::find($pinjaman->buku_id);
        Pinjaman::find($id)->delete($id);
        $buku->update([
            'jumlah_buku' => $buku->jumlah_buku,+1,
            'pinjaman' => $buku->pinjaman,-1
        ]);
        Aktifitasadmin::create([
                'user_id' => Auth()->user()->id,
                'icon' => 'fas fa-book-reader', 
                'backgroud' => 'bg-danger',
                'notifikasi' => Auth()->user()->nama. ' menghapus pinjaman ' .$pinjaman->nama. ' dengan judul buku ' .$pinjaman->judu_buku,
            ]);
        return back()->with([
            'alert' => 'success',
            'pesan' => 'Pinjaman berhasil dihapus',
            'color' => 'green'
        ]);
    }
}
