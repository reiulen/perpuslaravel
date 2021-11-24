@extends('profil.layout.main')

@section('main')
    @section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection
                        <form>
                          <div class="input-group col-6 col-md-4 float-right py-3">
                            <input type="text" name="pinjam" value="{{ request('pinjam') }}" class="form-control" placeholder="Search">
                            <div class="input-group-append">                                            
                              <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </form>
                    <div class="table-responsive py-2">
                      <table class="table table-striped" id="table-petugas">
                        <thead>
                          <tr>
                            <th class="text-center">
                              Judul Buku
                            </th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($pinjam as $row)
                            <tr>
                                <td>{{ $row->judul_buku }}</td>
                                <td>{{ date("l, d F Y", strtotime($row->tgl_pinjam )) }}</td>
                                <td>{{ date("l, d F Y", strtotime($row->tgl_kembali )) }}</td>
                                <td><div class="badge @if($row->status == 'Dipinjam') badge-primary  @elseif($row->status == 'Belum diambil') badge-secondary @elseif($row->status == 'Dikembalikan') badge-success @elseif($row->status == 'Denda') badge-danger @endif" style="font-weight: 450 !important;">{{ $row->status }}</div></td>
                                 <td>{{ $row->denda }}</td>
                                <td>
                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v" type="button" id="pinjamdrop{{ $row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="pinjamdrop{{ $row->id }}">
                                          <a class="dropdown-item" href="{{ route('cetakpinjamanuser', [$row->email, $row->id]) }}"><i class="fa fa-file"></i>  Cetak Pinjaman</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> Lihat Detail</a>
                                            @if($row->status == 'Belum diambil')
                                                <a class="dropdown-item hapusPinjam" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Batal</a>
                                                <form action="{{ route('pinjamanus', $row->id) }}" method="POST" id="hapusPinjaman{{ $row->id }}">
                                                @csrf
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="float-right">
                      {{ $pinjam->links() }}
                    </div>
                  


      @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script>
          $(".hapusPinjam").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Batal Pinjaman',
                  content: 'Apakah yakin akan membatalkan pinjaman?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Yakin',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusPinjaman${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });
          

           @if(!$pinjam->count())
              $('tbody').html('<td>&nbsp;</td><td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Pinjaman tidak ditemukan</h5></td>');
           @endif

        </script>
      @endsection
@endsection