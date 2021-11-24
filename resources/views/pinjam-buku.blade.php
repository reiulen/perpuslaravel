@extends('layout.main')

@section('content')
@section('css')
  <script type="module" src="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/duet.esm.js"></script>
  <script nomodule src="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/duet.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/themes/default.css" />
@endsection
   <section class="pinjam-buku">
       <div class="container">
           <div class="row">
               <div class="col-lg-8 col-md-12 col-sm-12 col-12 card mx-auto">
                   <div class="card-header">
                       <h4>Pinjam Buku</h4>
                   </div>
                   <div class="card-body">
                       <div class="row pb-3">
                           <div class="col-md-4 text-center">
                                <p class="pb-2 my-0">{{ $buku->judul_buku }}</p>
                                <img src="{{ asset('storage/'.$buku->gambar_buku) }}" class="img-thumbnail" style="width: 200px; height:220px; object-fit:cover; object-position:center; justify-content:center; align-items:center;">
                           </div>
                           <div class="col-md-8 px-5 pt-4">
                                <form action="{{ route('pinjam', $buku->id) }}" method="POST" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="date">Tanggal Pinjam</label>
                                        <input type="date" class="form-control " name="tgl_pinjam" data-date-format="DD MMMM YYYY"  onchange="tgl_awal(this.value)" id="tgl_pinjam">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="date">Tanggal Pengembalian</label>
                                        <input type="date" class="form-control " name="tgl_kembali" id="tgl_akhir">
                                    </div>
                                    <div class="form-group mt-3 text-center">
                                        <button class="btn btn-primary col-lg-5 mx-1 my-1 shadow-none" type="submit" style="font-weight:400;">Pinjam Buku</button>
                                        <a href="{{ route('detail-buku', [$buku->kategori, $buku->slug]) }}" class="btn btn-danger col-lg-5 my-1 mx-1 shadow-none" style="font-weight:400;">Batal</a>
                                    </div>
                                </form>
                           </div>
                       </div>
                       
                       
                   </div>
               </div>
           </div>
       </div>
   </section>
   @section('script')
        <script>
        document.getElementById("tgl_pinjam").min = "{{ date('Y-m-d') }}";
        document.getElementById("tgl_pinjam").dateFormat = "dd/mm/yyyy"

        function tgl_awal(val){
            document.getElementById("tgl_akhir").min = val;
            
        }
            function date(val) {
                $("#kembali").attr('val', val);
            }
        </script>
   @endsection
@endsection