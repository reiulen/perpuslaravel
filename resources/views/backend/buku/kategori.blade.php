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
              <div class="breadcrumb-item">Data Kategori</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Data Kategori</h1>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <button class="btn btn-primary mb-3"  data-toggle="modal" data-target="#modalTambah"><i class="fa fa-edit"></i> Tambah Kategori</button>
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
                            <th>
                              No
                            </th>
                            <th>Kategori</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Jumlah Buku Sesuai Kategori</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($kategori as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><a href="{{ route('kategori', $row->kategori) }}">{{ $row->kategori }}</a></td>
                                <td class="text-center"><div class="badge {{ ($buku->where('kategori_id', $row->id)->count() == 0) ? 'badge-primary' : 'badge-danger' }}">{{ ($buku->where('kategori_id', $row->id)->count() == 0) ? 'Bisa dihapus' : 'Tidak bisa dihapus' }}</div></td>
                                <td class="text-center">{{ $buku->where('kategori_id', $row->id)->count() }}</td>
                                <td>
                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v" type="button" id="kategoridrop{{ $row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="kategoridrop{{ $row->id }}">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modalEdit{{ $row->id }}"><i class="fa fa-edit"></i> Edit Kategori</a>
                                            @if($buku->where('kategori_id', $row->id)->count()==0)
                                                <a class="dropdown-item hapusKategori" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                                <form action="{{ route('kategori.destroy',$row->id) }}" method="POST" id="hapusKategori{{ $row->id }}">
                                                @csrf
                                                @method('delete')
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
                    <div class="float-left col-6 pt-4">
                        <span class="text-small text-dark">*Jika ingin menghapus kategori, hapus buku yang terkait dengan kategori tersebut! atau bisa juga mengganti kategori bukunya!</span>
                    </div>
                    <div class="float-right">
                      {{ $kategori->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


      <!-- Modal -->
      @foreach($kategori as $row)
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kategori.store') }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" id="kategori" class="form-control" name="kategori" required autofocus>
                            <div class="invalid-feedback">
                                Kategori tidak boleh kosong!
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEdit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kategori.update', $row->id) }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" id="kategori" value="{{ $row->kategori }}" class="form-control" name="kategori" required autofocus>
                            <div class="invalid-feedback">
                                Kategori tidak boleh kosong!
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
      @endforeach
      @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script>
          $(".hapusKategori").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Kategori',
                  content: 'Apakah yakin akan tetap mengahapus? Sebelum kategori dihapus, buku dalam kategori ini harus di hapus!',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusKategori${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });
          

           @if(!$kategori->count())
              $('tbody').html('<td>&nbsp;</td><td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Belum ada kategori</h5></td>');
           @endif

        </script>
      @endsection
@endsection