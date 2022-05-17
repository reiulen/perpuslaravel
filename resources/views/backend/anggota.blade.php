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
              <div class="breadcrumb-item">Data Anggota</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Data Anggota</h1>

            <div class="card">
                <div class="card-body">
                  <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link {{ (!request('status')) ? 'active' : '' }}" href="{{ route('anggota') }}">Semua <span class="badge {{ (!request('status')) ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Aktif') ? 'active' : '' }}" href="{{ route('anggota') }}?status=Aktif">Aktif <span class="badge {{ (request('status')=='Aktif') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Aktif')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Verify') ? 'active' : '' }}" href="{{ route('anggota') }}?status=Verify">Verify <span class="badge {{ (request('status')=='Verify') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Verify')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Nonaktif') ? 'active' : '' }}" href="{{ route('anggota') }}?status=Nonaktif">Nonaktif <span class="badge {{ (request('status')=='Nonaktif') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Nonaktif')->count() }}</span></a>
                      </li>
                  </ul>
                </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                      <a href="{{ route('daftar.index') }}" class="link">
                        <button class="btn btn-primary mb-3"><i class="fa fa-edit"></i> Tambah Anggota</button>
                      </a>
                      <div class="float-right">
                        <form>
                          <div class="input-group">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search">
                             @if(request('status'))
                                <input type="hidden" name="status" value="{{ request('status') }}">
                            @endif
                            <div class="input-group-append">                                            
                              <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>
                    <div class="table-responsive py-2">
                      <table class="table table-striped" id="table-anggota" >
                        <thead>
                          <tr>
                            <th class="text-center">
                              Id Anggota
                            </th>
                            <th class="text-center">
                              Foto
                            </th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Aktifitas</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($anggota as $row)
                            <tr>
                                <td>{{ $row->id_anggota}}</td>
                                <td><img src="{{ asset('storage/'.$row->foto) }}" class="rounded-circle border-0"></td>
                                <td>{{ $row->nis }}</td>
                                <td>{{ $row->nama }}</td>
                                <td><div class="badge @if($row->status=='Aktif') badge-primary @elseif($row->status=='Verify') badge-success @elseif($row->status=='Nonaktif') badge-danger @endif   ">{{ $row->status }}</div></td>
                                <td>{{ $row->aktifitas }} {{ $row->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v" type="button" id="petugasdrop{{ $row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="petugasdrop{{ $row->id }}">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modalEdit{{ $row->id }}"><i class="fa fa-edit"></i> Edit Anggota</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modalAnggota{{ $row->id }}" href="#"><i class="fa fa-eye"></i> Lihat Detail</a>
                                            <a class="dropdown-item hapusAnggota" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                            <form action="{{ route('anggotadelete', $row->id) }}" method="POST" id="hapusAnggota{{ $row->id }}">
                                              @csrf
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
                      {{ $anggota->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

    <style>
        tbody img{
            height: 50px;
        }
        th{
            background-color: rgb(238, 238, 238) !important;
        }
        td{
            background-color: transparent !important;
        }
    </style>
      <!-- Modal -->
      @foreach($anggota as $row)
       <div class="modal fade" id="modalEdit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('anggotaupdate', $row->id) }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Status Anggota</label>
                            <select class="form-control" name="status">
                              <option value="{{ $row->status }}" selected disabled>{{ $row->status }}</option>
                              <option value="Nonaktif">Nonaktif</option>
                              <option value="Aktif">Aktif</option>
                            </select>
                            <div class="invalid-feedback">
                                Status tidak boleh kosong!
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                        <button class="btn btn-primary col-2" type="submit">Edit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="modalAnggota{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('storage/'.$row->foto) }}" class="img-thumbnail">
                        </div>
                        <div class="col-8">
                            <table class="table">
                                <tr>
                                    <th class="table-active">Id Anggota</th>
                                    <td>{{ $row->id_anggota }}</td>
                                </tr>
                                <tr>
                                    <th class="table-active">Nis</th>
                                    <td>{{ $row->nis }}</td>
                                </tr>
                                <tr>
                                    <th class="table-active">Nama</th>
                                    <td>{{ $row->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="table-active">Email</th>
                                    <td>{{ $row->email }}</td>
                                </tr>
                                <tr>
                                    <th class="table-active">Jenis Kelamin</th>
                                    <td>{{ $row->jenis_kelamin }}</td>
                                </tr>
                                 <tr>
                                    <th class="table-active">Kelas</th>
                                    <td>{{ $row->kelas }}</td>
                                </tr>
                                <tr>
                                    <th class="table-active">Status</th>
                                    <td>{{ $row->status }}</td>
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
                    </div>
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
          $(".hapusAnggota").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Anggota',
                  content: 'Apakah yakin akan tetap mengahapus?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusAnggota${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });
          
           @if(!$anggota->count())
              $('tbody').html('<td>&nbsp;</td><td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Anggota tidak ditemukan</h5></td>');
           @endif

        </script>
      @endsection
@endsection