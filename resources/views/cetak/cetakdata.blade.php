<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cetak Transaksi Tanggal {{  date('d F Y', strtotime(request('dari'))) }} Sampai {{  date('d F Y', strtotime(request('sampai'))) }}</title>
  </head>
  <body>
      <style>
        table{
            width: 100%;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        table, th, td{
            border: 1px solid;
            border-collapse: collapse;
            text-align: center;
            align-items: center;
            justify-content: center;
        }
      </style>
        <div class="judul" style="align-items:center; justify-content:center; text-align:center; margin-bottom:30px;">
            <img src="{{ asset('e-perpus.png') }}" style="height: 60px">
            <h2 style="">Laporan Pinjaman Buku E-Perpus</h2>
            <h4 style=" margin-top:-10px;"> Tanggal  {{  date('d F Y', strtotime(request('dari'))) }} -   {{  date('d F Y', strtotime(request('sampai'))) }}</h4>
        </div>
        <table>
            <tr style="background-color: bisque"> 
                <th>No</th>
                <th>Id Anggota</th> 
                <th>Nama</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach($pinjaman as $tr)
            <tr> 
                <td>{{ $no++ }}</td>
                <td>{{ $tr->id_anggota }}</td>
                <td>{{ $tr->nama_peminjam }}</td> 
                <td>{{ $tr->kelas }}</td> 
                <td>{{ $tr->jenis_kelamin }}</td> 
                <td>{{ $tr->kelas }}</td>
                <td>{{ $tr->judul_buku }}</td>
                <td>{{ date('d F Y', strtotime($tr->tgl_pinjam )) }}</td>
                <td>{{ date('d F Y', strtotime($tr->tgl_kembali )) }}</td>
                <td>{{ $tr->status }}</td>
                <td>{{ $tr->denda }}</td>
            </tr>
            @endforeach
            @if($pinjaman->count() == 0)
                <h4 style="text-align: center">Tidak ditemukan</h4>
            @endif
        </table> 
        

    
  </body>
</html>