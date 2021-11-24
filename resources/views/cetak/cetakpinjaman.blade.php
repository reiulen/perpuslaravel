<!DOCTYPE html>
<head>
    <title>Cetak Pinjaman {{$pinjaman->judul_buku}}</title>
    <meta charset="utf-8">
    <style>
    #halaman{
        width:100%;
    }
        #judul{
            text-align:center;
        }
        h4{
            margin:0px;
            text-align:center;
        }

        #halaman{
            width: 627px; 
            height: auto; 
            align-items:center;
            position: absolute; 
            border: 1px solid; 
            padding-top: 30px; 
            padding-left: 30px; 
            padding-right: 30px; 
            padding-bottom: 80px;
        }

        img{
            height: 40px;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        table{
            margin:65px 20px;
        }
        .tr{
            margin:200px;
        }
        p{
            font-size:10px;
            align-items:center;
            margin-top:100px;
        }
    </style>

</head>

<body>
    <div id=halaman>
        <img src="{{ asset('e-perpus.png') }}">
        <h3 id=judul>E Perpus SMKN 1 Ciamis</h3>
        <h4>Form Peminjaman Buku</h4>


        <table>
            <tr>
                <td style="width: 30%;">Nama</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">{{ $pinjaman->nama_peminjam }}</td>
            </tr>
            <tr>
                <td style="width: 30%;">Email</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">{{ $pinjaman->email}}</td>
            </tr>
            <tr>
                <td style="width: 30%;">Kelas</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">{{ $pinjaman->kelas }}</td>
            </tr>
            <tr>
                <td style="width: 30%;">Judul Buku</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">{{ $pinjaman->judul_buku }}</td>
            </tr>
            <tr>
                <td style="width: 30%; vertical-align: top;">Tanggal Peminjaman</td>
                <td style="width: 5%; vertical-align: top;">:</td>
                <td style="width: 65%;">{{ date('d F Y', strtotime($pinjaman->tgl_pinjam)) }}</td>
            </tr>
            <tr>
                <td style="width: 30%;">Tanggal Pengembalian</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">{{ date('d F Y', strtotime($pinjaman->tgl_kembali)) }}</td>
            </tr>
        </table>


        <div style="width: 50%; text-align: center; float: right;">Ciamis, {{ date(" d F Y ") }}</div><br>
        <br><br><br><br><br>
        <div style="width: 50%; text-align: center; float: right;">Petugas</div>
        <p>dicetak oleh E-Perpus SMKN 1 Ciamis</p>
    </div>
    
</body>

</html>