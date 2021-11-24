<div class="row py-5 justify-content-center">
    @foreach($buku as $row)
        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-7 card" style="background-image:url({{ asset('storage/'.$row->gambar_buku) }}) !important; background-size:cover !important; background-position:center !important; border-radius:12px;">
            <div class="content">
                <h4>{{ $row->judul_buku }}</h4>
                <a class="lihat-selengkapnya" href="{{ route('detail-buku', [$row->kategori->kategori, $row->slug]) }}">Lihat Buku</a>
            </div>
        </div>
    @endforeach
</div>

@if($bukukategori->count()<0)
    <h1>Belum ada buku</h1>
@endif