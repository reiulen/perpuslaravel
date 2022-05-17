@extends('backend.layout.main')

@section('content')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection
<div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item">Data Petugas</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Data Petugas</h1>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                      <a href="{{ route('petugas.create') }}" class="link">
                        <button class="btn btn-primary mb-3"><i class="fa fa-edit"></i> Tambah Petugas</button>
                      </a>
                      <div class="float-right">
                        <form>
                          <div class="input-group">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search">
                            <div class="input-group-append">                                            
                              <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>
                    <div class="table-responsive py-2">
                      <table class="table table-striped" id="table-petugas">
                        <thead>
                          <tr>
                            <th class="text-center">
                              Id Petugas
                            </th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Bergabung</th>
                            <th>Aktifitas</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($petugas as $row)
                            <tr>
                                <td>{{ $row->id_petugas }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ date("d F Y", strtotime($row->created_at)) }}</td>
                                <td>{{ $row->aktifitas }} {{ $row->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v" type="button" id="petugasdrop{{ $row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="petugasdrop{{ $row->id }}">
                                            <a class="dropdown-item" href="{{ route('petugas.edit', $row->id) }}"><i class="fa fa-edit"></i> Edit Petugas</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modalpetugas{{ $row->id }}" href="#"><i class="fa fa-eye"></i> Lihat Detail</a>
                                            <a class="dropdown-item hapusPetugas" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                            <form action="{{ route('petugas.destroy',$row->id) }}" method="POST" id="hapusPetugas{{ $row->id }}">
                                              @csrf
                                              @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="float-right">
                      {{ $petugas->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


      <!-- Modal -->
      @foreach($petugas as $row)
        <div class="modal fade" id="modalpetugas{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                       <tr>
                           <th class="table-active">Nama</th>
                           <td>{{ $row->nama }}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Username</th>
                           <td>{{ $row->username }}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Bergabung</th>
                           <td>{{ date("d F Y", strtotime($row->created_at)) }}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Aktifitas</th>
                           <td>{{ $row->aktifitas }} {{ $row->updated_at->diffForHumans() }}</td>
                       </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                </div>
                </div>
            </div>
        </div>
      @endforeach
      @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script>
          $(".hapusPetugas").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Petugas',
                  content: 'Apakah yakin akan tetap mengahapus?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusPetugas${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });
          

           @if(!$petugas->count())
              $('tbody').html('<td>&nbsp;</td><td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Belum ada petugas</h5></td>');
           @endif

        </script>
      @endsection
@endsection