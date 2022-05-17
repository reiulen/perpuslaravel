@extends('layout.main')
@section('content')
@section('css')
  <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel/owl.carousel.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel/owl.theme.default.min.css') }}"/>
@endsection
<section class="carousel-main">
    <div class="container-fluid">
        <div class="owl-carousel owl-theme carousel-heading slider">
            @foreach($thumbnail as $row)
                <div><a class="text-decoration-none" href="{{ $row->link }}"><img src="{{ asset('storage/'.$row->gambar) }}"></a></div>
            @endforeach
        </div>
    </div>
</section>
<section class="buku-terpopuler my-5">
    <div class="container">
        <div class="button-slider float-right mx-5"></div>
        <h2 class="text-blue">Buku Terpopuler</h2>
        <div class="owl-carousel owl-theme slider-buku-terpopuler row py-3 mx-auto" >
            @php
                $i = 1;
            @endphp
            @foreach($bukupopuler as $row)
                <div class="card" style="background-image:url({{ asset('storage/'.$row->gambar_buku) }}) !important; background-size:cover !important; background-position:center !important; border-radius:12px;">
                    <h1 class="display-2">{{ $i++ }}</h1>
                    <div class="content">
                        <h4>{{ $row->judul_buku }}</h4>
                        <a class="lihat-selengkapnya" href="{{ route('detail-buku',[$row->kategori->kategori, $row->slug]) }}" >Lihat Buku</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@foreach($kat as $row)
<section class="buku-kategori">
    <div class="container">
        <a class="me-5" href="{{ route('kategori', $row->kategori) }}"><p class="float-right">Lihat Semua</h5></a>
        <h2 class="text-blue">{{ $row->kategori }}</h2>
        <div id="buku-kategori{{ $row->id }}"></div>
    </div>
</section>
@endforeach

<div class="modal fade bd-example-modal-lge" id="modaleperpus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">E Perpus SMKN 1 Ciamis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row py-2">
            <div class="col-sm-5">
                <img src="{{ asset('assets/img/header.svg') }}">
            </div>
            <div class="col-sm-7 my-2 sm-text-center">
                <p class="pb-0 mb-0">Mari memulai dengan E-Perpus</p>
                <h3 class="text-primary">Meminjam buku Perpustakaan dengan kemudahan</h3>
                 <div class="row pt-2">
                    <a href="{{ route('daftar.index') }}" class="btn btn-primary col-4 ml-3 shadow-none">Daftar</a>
                    <a href="{{ route('login.index') }}" class="btn btn-outline-primary col-4 mx-3 shadow-none">Login</a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

    @section('script')
     <script src="{{ asset('assets/js/owl-carousel/owl.carousel.min.js') }}"></script>
     <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script>
        @if(!Auth::guard('anggota')->user())
            $('#modaleperpus').modal('show');
        @endif
            @foreach($kat as $row)
                $('#buku-kategori{{ $row->id }}').load('{{ route('tampil',$row->kategori) }}');
            @endforeach
        </script>
    @endsection
@endsection
