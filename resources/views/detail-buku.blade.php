@extends('layout.main')

@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrapsocial.css') }}">
@endsection
    <section class="detail-buku">
        <div class="container">
            <div class="row">
                <div class="col-md-4 gambar-detail-buku text-center">
                    <img src="{{ asset('storage/'.$buku->gambar_buku) }}" class="img-fluid">
                </div>
                <div class="col-md-8 mt-3">
                    <h3>{{ $buku->judul_buku }}</h3>
                    <p class="badge badge-primary" style="font-weight: 400 !important">{{ $buku->kategori->kategori }}</p>
                    <table class="table">
                       <tr>
                           <th class="table-active">Pengarang</th>
                           <td>{{ $buku->pengarang }}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Tahun Terbit</th>
                           <td>{{ $buku->tahun_terbit }}</td>
                       </tr>
                        <tr>
                           <th class="table-active">Penerbit</th>
                           <td>{{ $buku->penerbit }}</td>
                       </tr>
                        <tr>
                           <th class="table-active">ISBN</th>
                           <td>{{ $buku->isbn }}</td>
                       </tr>
                        <tr>
                           <th class="table-active">Jumlah Buku</th>
                           <td>{{ $buku->jumlah_buku }}</td>
                       </tr>
                    </table>
                    <p>{!! $buku->deskripsi !!}</p>
                </div>
            </div>
            <div class="d-md-flex my-5 menu-button d-none">
                 @if(!Auth::guard('anggota')->user())
                    <a class="btn btn-primary col-sm-3 ms-2 button" style="border-radius:50px;" @if($buku->jumlah_buku > 0 )
                    href="{{ route('pinjambuku',$buku->slug ); }}"
                    @else
                    id="habishp"
                    @endif>
                    Pinjam Buku
                </a>
                @endif
                @if(Auth::guard('anggota')->user())
                    <a class="btn btn-primary col-sm-3 ms-2 button" style="border-radius:50px;" @if($buku->jumlah_buku > 0 AND !$pinjam->count())
                    href="{{ route('pinjambuku',$buku->slug ); }}"
                    @else
                        id="habishp"
                    @endif>
                    Pinjam Buku
                    </a>                  
                @endif
                <a href="" class="btn btn-outline-primary col-sm-2 mx-3 button" data-toggle="modal" data-target="#modalshare"><i class="fas fa-share-alt"></i> Share</a>
            </div>
        </div>
    </section>
    <header class="buttom-header fixed-bottom d-md-none d-block bg-white">
        <div class="container">
            <div class="d-flex my-3 menu-button">
                @if(!Auth::guard('anggota')->user())
                    <a class="btn btn-primary col-9 ms-2 button" style="border-radius:50px;" @if($buku->jumlah_buku > 0 )
                    href="{{ route('pinjambuku',$buku->slug ); }}"
                    @else
                    id="habishp"
                    @endif>
                    Pinjam Buku
                </a>
                @endif
                @if(Auth::guard('anggota')->user())
                    <a class="btn btn-primary col-9 ms-2 button" style="border-radius:50px;" @if($buku->jumlah_buku > 0 AND !$pinjam->count())
                    href="{{ route('pinjambuku',$buku->slug ); }}"
                    @else
                        id="habishp"
                    @endif>
                    Pinjam Buku
                    </a>                  
                @endif
                <button class="btn btn-outline-primary col-2 mx-3" data-toggle="modal" data-target="#modalshare"><i class="fas fa-share-alt"></i></button>
            </div>
        </div>
    </header>
    <section class="detail-buku-rekomendasi mt-2 mb-5">
    <div class="container">
        <h2 class="py-3" style="color: #0b153a !important;">Rekomendasi</h2>
        <div class="row justify-content-center pb-5">
            @foreach($bukupopuler as $row)
            <div class="col-lg-2 col-md-4  col-sm-4 col-7 card" style="background-image:url({{ asset('storage/'.$row->gambar_buku) }}) !important; background-size:cover !important; background-position:center !important; border-radius:12px;">
                <div class="content">
                    <h4>{{ $row->judul_buku }}</h4>
                    <a class="lihat-selengkapnya" href="{{ route('detail-buku', [$row->kategori->kategori, $row->slug]) }}">Lihat Buku</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modalshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Share Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="text-center">
                <a href="https://facebook.com/sharer/sharer.php?u=Dapatkan pinjaman buku {{ $buku->judul_buku }} di E Perpus SMKN 1 Ciamis {{ route('detail-buku', [$buku->kategori, $buku->slug]) }}" target="_blank" rel="noopener" aria-label="Share on Facebook"  class="btn btn-social-icon btn-facebook mr-1 rounded-circle">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="whatsapp://send?text=Dapatkan pinjaman buku {{ $buku->judul_buku }} di E Perpus SMKN 1 Ciamis {{ route('detail-buku', [$buku->kategori, $buku->slug]) }}" target="_blank" rel="noopener" aria-label="Share on Whatsapp" class="btn btn-social-icon btn-success mr-1 rounded-circle">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://twitter.com/intent/tweet/?text=Dapatkan pinjaman buku {{ $buku->judul_buku }} di E Perpus SMKN 1 Ciamis {{ route('detail-buku', [$buku->kategori, $buku->slug]) }}" target="_blank" rel="noopener" aria-label="Share on Twitter"  class="btn btn-social-icon btn-twitter mr-1 rounded-circle">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="mailto:?subject=Dapatkan pinjaman buku {{ $buku->judul_buku }} di E Perpus SMKN 1 Ciamis {{ route('detail-buku', [$buku->kategori, $buku->slug]) }}" target="_blank" rel="noopener" aria-label="Share on Twitter"  class="btn btn-social-icon btn-twitter mr-1 rounded-circle">
                    <i class="fa fa-envelope"></i>
                </a>
            </div>
      </div>
    </div>
  </div>
</div>
@section('script')
    <script>
       @if(Auth::guard('anggota')->user())
         @if($pinjam->count())
            $('#habis').click(function(){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000,
                    buttonColor:'red',
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Anda sudah meminjam buku ini!'
                })      
            })
        @endif
        @if($pinjam->count())
            $('#habishp').click(function(){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    buttonColor:'red',
                    timer: 6000,
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Anda sudah meminjam buku ini!'
                })      
            })
        @endif
       @endif
         @if($buku->jumlah_buku == 0)
            $('#habis').click(function(){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000,
                    buttonColor:'red',
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Buku habis, silahkan cari buku yang lain!'
                })      
            })
        @endif
        @if($buku->jumlah_buku == 0)
            $('#habishp').click(function(){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    buttonColor:'red',
                    timer: 6000,
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Buku habis, silahkan cari buku yang lain!'
                })      
            })
        @endif
    </script>
@endsection
@endsection