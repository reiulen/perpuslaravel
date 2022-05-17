@extends('layout.main')

@section('content')
    <section class="kategori">
        <div class="container">
            <div class="row justify-content-center">
                <p id="semuakategori" class="nav-kategori shadow-none mx-2 px-4 btn {{ ($kategori->kategori == 'semua') ? 'btn-primary' : 'btn-outline-primary' }}" style="border-radius: 50px">Semua</p>
                @foreach($kat as $row)
                    <p id="kategori{{ $row->id }}" class="nav-kategori shadow-none mx-2 px-4  btn {{ ($kategori->kategori == $row->kategori) ? 'btn-primary' : 'btn-outline-primary' }}" style="border-radius: 50px">{{ $row->kategori }}</p>
                @endforeach
            </div>
        </div>
    </section>
    <section class="buku-kategori mt-5 bg-light">
        <div class="container">
           <div class="pt-3 pb-5" id="buku-kategori"></div>
        </div>
    </section>
    @section('script')
    <script>
        $('body').addClass(' ');
       @if($buku)
         $('#buku-kategori').load('{{ route('tampil',$kategori->kategori) }}');
       @endif
        $('#semuakategori').click(function(){
            $('#buku-kategori').load('{{ route('semuabuku') }}');
        });
        @foreach($kat as $row)
           $('#kategori{{ $row->id }}').click(function(){
                $('#buku-kategori').load('{{ route('tampil',$row->kategori) }}');
           });
        @endforeach
        $('.nav-kategori').click(function(){
           @foreach($kat as $row)
             $('#kategori{{ $row->id }}').removeClass('btn-primary');
             $('#kategori{{ $row->id }}').addClass('btn-outline-primary');
           @endforeach
            $('#semuakategori').removeClass('btn-primary');
            $('#semuakategori').addClass('btn-outline-primary');
            $(this).addClass('btn-primary');
            $(this).removeClass('btn-outline-primary');
        });
    </script>
    @endsection
@endsection 