<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use PDF;

class CetakController extends Controller
{
    public function cetakpinjamanUser($user, $pinjaman)
    {
        $pinjaman = Pinjaman::where('id', $pinjaman)->first();
        $pdf = PDF ::loadview('cetak.cetakpinjaman', compact('pinjaman'))->setPaper('A4', 'portrait');
        return $pdf->stream('cetakpinjaman'.$pinjaman->judul_buku.'.pdf');
    }
    public function cetakpinjaman($user, $pinjaman)
    {
        $pinjaman = Pinjaman::where('id', $pinjaman)->first();
        $pdf = PDF ::loadview('cetak.cetakpinjaman', compact('pinjaman'))->setPaper('A4', 'portrait');
        return $pdf->stream('cetakpinjaman'.$pinjaman->judul_buku.'.pdf');
    }

    public function cetakdata(Request $request)
    {
        $pinjaman = Pinjaman::whereBetween('created_at', [$request->dari, $request->sampai])->get();
        $pdf = PDF ::loadview('cetak.cetakdata', compact('pinjaman'))->setPaper('a4', 'landscape');
        return $pdf->stream('cetakpinjaman.pdf');
    }
}
