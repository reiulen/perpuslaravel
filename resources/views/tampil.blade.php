<div class="row pt-3 pb-2 justify-content-center">
    @if($bukukategori->count() == 0)
    <h5 class="text-center">Belum ada buku kategori ini</h5>
    @endif
    @foreach($bukukategori->where('status', 'Publish') as $buku)
        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-7 card" style="background-image:url({{ asset('storage/'.$buku->gambar_buku) }}) !important; background-size:cover !important; background-position:center !important; border-radius:12px;">
            <div class="content">
                <h4>{{ $buku->judul_buku }}</h4>
                <a class="lihat-selengkapnya" href="{{ route('detail-buku', [$buku->kategori, $buku->slug]) }}">Lihat Buku</a>
            </div>
        </div>
    @endforeach
</div>



            