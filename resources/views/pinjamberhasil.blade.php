@extends('layout.main')

@section('content')

<section class="pinjam-berhasil">
    <div class="container">
        <div class="row">
            <div class="alert alert-primary text-small  mx-auto " role="alert">
                        *Selamat pinjamanmu sudah berhasil dibuat!, silahkan cetak pinjaman untuk mengambil buku di perpustakaan
                    </div>
            <div class="col-lg-8 col-md-12 col-sm-12 col-12 card mx-auto">
                <div class="card-header">
                    <h4>Pinjaman Berhasil!</h4>
                </div>
                <div class="card-body">
                   <div class="thumbnail-pinjam text-center pb-3">
                        <img src="{{ asset('storage/'.$pinjam->buku->gambar_buku)}}"  class="img-thumbnail" style="width: 200px; height:220px; object-fit:cover; object-position:center; justify-content:center; align-items:center;">
                    <h5 class="py-2">{{ $pinjam->judul_buku }}</h5>
                   </div>
                    <table class="table">
                       <tr>
                           <th class="table-active">ID Anggota</th>
                           <td>{{ $pinjam->id_anggota }}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Nama</th>
                           <td>{{ $pinjam->nama_peminjam }}</td>
                       </tr>
                        <tr>
                           <th class="table-active">Tanggal Pinjam</th>
                           <td>{{ date("l, d F Y", strtotime($pinjam->tgl_pinjam) )}}</td>
                       </tr>
                        <tr>
                           <th class="table-active">Tanggal Kembali</th>
                           <td>{{ date("l, d F Y", strtotime($pinjam->tgl_kembali) )}}</td>
                       </tr>
                    </table>
                    <div class="cetak-pinjam text-center py-4">
                        <a href="{{ route('cetakpinjamanuser', [$pinjam->email, $pinjam->id]) }}" class="btn btn-primary col-md-6" style="border-radius: 50px; font-weight: 500 !important;"><i class="fa fa-file"></i> Cetak Pinjaman</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection