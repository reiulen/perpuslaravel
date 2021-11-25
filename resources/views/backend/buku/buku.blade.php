@extends('backend.layout.main')

@section('content')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection
<div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="">Admin</a></div>
              <div class="breadcrumb-item">Data Buku</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Data Buku</h1>

            <div class="card">
                <div class="card-body">
                  <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link {{ (!request('status')) ? 'active' : '' }}" href="{{ route('buku.index') }}">Semua <span class="badge {{ (!request('status')) ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Publish') ? 'active' : '' }}" href="{{ route('buku.index') }}?status=Publish">Publish <span class="badge {{ (request('status')=='Publish') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Publish')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Draft') ? 'active' : '' }}" href="{{ route('buku.index') }}?status=Draft">Draft <span class="badge {{ (request('status')=='Draft') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Draft')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Pending') ? 'active' : '' }}" href="{{ route('buku.index') }}?status=Pending">Pending <span class="badge {{ (request('status')=='Pending') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Pending')->count() }}</span></a>
                      </li>
                  </ul>
                </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>@if(request('status'))
                      {{ request('status') }}
                      @else
                      Semua
                    @endif Buku</h4>
                  </div>
                  <div class="card-body">
                      <a href="{{ route('buku.create') }}" class="link">
                        <button class="btn btn-primary mb-3"><i class="fa fa-edit"></i> Tambah Buku</button>
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
                      <table class="table table-striped border-0" id="table-buku">
                        <thead>
                          <tr>
                            <th>Judul Buku</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Buku</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Kategori</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($buku as $row)
                            <tr>
                                <td>{{ $row->judul_buku }}</td>
                                <td style="cursor:pointer;" data-toggle="modal"  data-target="#gambar_buku{{ $row->id }}" ><img src="{{ asset('storage/'.$row->gambar_buku) }}" class="img-thumbnail" style="width:150px; border-radius:6px; box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.3);"></td>
                                <td>{!! substr($row->deskripsi, 0, 150) !!}</td>
                                <td>{{ $row->jumlah_buku }}</td>
                                <td>{{ $row->pinjaman }}</td>
                                <td><a href="{{ route('kategori', $row->kategori) }}">{{ $row->kategori->kategori }}</a></td>
                                <td>
                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v" type="button" id="petugasdrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="petugasdrop">
                                            <a class="dropdown-item" href="{{ route('buku.edit', $row->id) }}"><i class="fa fa-edit"></i> Edit Buku</a>
                                            <a class="dropdown-item" href="{{ route('detail-buku',[$row->kategori->kategori,$row->slug]) }}"><i class="fa fa-eye"></i> Lihat Buku</a>
                                            <a class="dropdown-item hapusBuku" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                            <form action="{{ route('buku.destroy', $row->id) }}" method="POST" id="hapusBuku{{ $row->id }}">
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
                      {{ $buku->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
        </section>
      </div>


      <!-- Modal -->
    @foreach($buku as $row)
    <div class="modal fade" id="gambar_buku{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content  shadow-none" style="background:none !important;">
            <img src="{{ asset('storage/'.$row->gambar_buku) }}" class="img-thumbnail">
        </div>
      </div>
    </div>
    @endforeach
    

      @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script>
          $(".hapusBuku").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Buku',
                  content: 'Apakah yakin akan tetap mengahapus?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusBuku${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });

          @if(!$buku->count())
             $('tbody').html('<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Buku tidak ditemukan</h5></td>');
          @endif

        </script>
      @endsection
@endsection