@extends('layout.main')

@section('content')
    <section class="hasil-search">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3>Hasil pencarian "{{ request('q') }}"</h3>
                    <div class="row justify-content-center pt-5 pb-3">
                        <a href="{{ url('search?q='.request('q')) }}" class="text-decoration-none">
                            <p class="mx-2 shadow-none {{ (request('q') AND request('kategori')) ? 'btn btn-outline-primary' : 'btn btn-primary' }}" style="border-radius: 50px; font-weight:400 !important;">Semua</p>
                        </a>
                        @foreach($kat as $row)
                        <a href="{{ url('search?q=') }}{{ request('q') }}&kategori={{ $row->kategori }}" class="text-decoration-none">
                            <p class="mx-2  shadow-none {{ (request('q') AND request('kategori')==$row->kategori) ? 'btn btn-primary' : 'btn btn-outline-primary' }}" style="border-radius: 50px; font-weight:400 !important;">{{ $row->kategori }}</p>
                        </a>
                        @endforeach
                        <hr>
                    </div>
                @foreach($buku as $row)
                    <div class="row my-3">
                       <a class="text-decoration-none" href="{{ route('detail-buku', [$row->kategori,$row->slug]); }}"  style="border:0!important;"> 
                        <div class=" col-lg-4 col-md-6 col-sm-6 col-6 gambar-search text-center">
                            <img src="{{ asset('storage/'.$row->gambar_buku) }}">
                        </div>
                       </a>
                        <div class="col-lg-8 col-md-6 col-sm-6 col-6 detail-hasil-search">
                            <a href="{{ route('detail-buku', [$row->kategori,$row->slug]); }}" style="color: #0b153a !important;">
                                <h3 style="font-weight: 600">{{ $row->judul_buku }}</h3>
                            </a>
                            <p class="py-0 my-0"><b>Pengarang :</b> {{ $row->pengarang }}</p>
                            <p class="py-0 my-0"><b>Penerbit :</b> {{ $row->penerbit }}</p>
                            <p class="py-0 my-0"><b>Tahun Terbit :</b> {{ $row->tahun_terbit }}</p>
                            <p>{!! substr($row->deskripsi, 0,200) !!}...</p>
                        </div>
                    </div>
                @endforeach
                @if(!$buku->count())
                    <h3>Maaf, hasil pencarian tidak dapat ditemukan</h3>
                    <p>Silahkan coba untuk mencari menggunakan kata kunci lain</p>
                @endif
                </div>
                <div class="col-md-4">
                    <h3 class="pb-2">Rekomendasi</h3>
                    <div class="row">
                        @foreach($bukupopuler->limit(3)->get() as $row)
                        <div class="col-4 rekomendasi-search">
                            <a href="{{ route('detail-buku',[$row->kategori->kategori, $row->slug]) }}" style="color: #0b153a !important;">
                                <img src="{{ asset('storage/'.$row->gambar_buku) }}" class="img-fluid">
                                <p>{{ $row->judul_buku }}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <h3 class="pt-4 pb-2">Terpopuler</h3>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($bukupopuler->limit(10)->get() as $hot)
                    <a href="{{ route('detail-buku',[$hot->kategori->kategori, $hot->slug]) }}" style="color: #0b153a !important;">
                        <div class="d-flex">
                            <h4>{{ $i++ }}</h4>
                            <p class="px-2">{{ $hot->judul_buku }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection