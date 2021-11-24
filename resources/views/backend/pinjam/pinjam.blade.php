@extends('backend.layout.main')

@section('content')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/themes/default.css" />
@endsection
<div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item">Data Pinjaman</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Data Pinjaman</h1>

             <div class="card">
                <div class="card-body">
                  <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link {{ (!request('status')) ? 'active' : '' }}" href="{{ route('pinjam.index') }}">Semua <span class="badge {{ (!request('status')) ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Dipinjam') ? 'active' : '' }}" href="{{ route('pinjam.index') }}?status=Dipinjam">Dipinjam <span class="badge {{ (request('status')=='Dipinjam') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Dipinjam')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Belum diambil') ? 'active' : '' }}" href="{{ route('pinjam.index') }}?status=Belum diambil">Belum Diambil <span class="badge {{ (request('status')=='Belum diambil') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Belum diambil')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Dikembalikan') ? 'active' : '' }}" href="{{ route('pinjam.index') }}?status=Dikembalikan">Dikembalikan <span class="badge {{ (request('status')=='Dikembalikan') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Dikembalikan')->count() }}</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{ (request('status')=='Denda') ? 'active' : '' }}" href="{{ route('pinjam.index') }}?status=Denda">Denda <span class="badge {{ (request('status')=='Denda') ? 'badge-white' : 'badge-primary' }}">{{ $jumlah->where('status', 'Denda')->count() }}</span></a>
                      </li>
                  </ul>
                </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                      <a href="{{ route('pinjam.create') }}" class="link">
                        <button class="btn btn-primary mb-3"><i class="fa fa-edit"></i> Tambah Pinjaman</button>
                      </a>
                      <button data-toggle="modal" data-target="#modalCetak" class="btn btn-primary mb-3 ml-2"><i class="fa fa-file"></i> Cetak Data Per Tanggal</button>
                      <div class="float-right">
                        <form>
                          <div class="input-group">
                            <input type="text" name="pinjam" value="{{ request('pinjam') }}" class="form-control" placeholder="Search">
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
                      <table class="table table-striped" id="table-petugas">
                        <thead>
                          <tr>
                            <th class="text-center">
                              Id Anggota
                            </th>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
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
                                <td>{{ $row->id_anggota }}</td>
                                <td>{{ $row->nama_peminjam }}</td>
                                <td>{{ $row->judul_buku }}</td>
                                <td>{{ date("d F Y", strtotime($row->tgl_pinjam)) }}</td>
                                <td>{{ date("d F Y", strtotime($row->tgl_kembali))}}</td>
                                <td><div class="badge @if($row->status == 'Dipinjam') badge-primary  @elseif($row->status == 'Belum diambil') badge-secondary @elseif($row->status == 'Dikembalikan') badge-success @elseif($row->status == 'Denda') badge-danger @endif" style="font-weight: 450 !important;">{{ $row->status }}</div></td>
                                <td>{{ $row->denda }}</td>
                                <td>
                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v" type="button" id="petugasdrop{{ $row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="petugasdrop{{ $row->id }}">
                                          <a class="dropdown-item" href="{{ route('cetakpinjaman', [$row->email, $row->id]) }}"><i class="fa fa-file"></i>  Cetak Pinjaman</a>
                                            <a class="dropdown-item"  data-toggle="modal" data-target="#modalEdit{{ $row->id }}"><i class="fa fa-edit"></i> Edit Pinjaman</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modalpinjam{{ $row->id }}" href="#"><i class="fa fa-eye"></i> Lihat Detail</a>
                                            @if($row->status == 'Belum diambil' OR $row->status == 'Dikembalikan')
                                                <a class="dropdown-item hapusPinjam" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                                <form action="{{ route('pinjam.destroy',$row->id) }}" method="POST" id="hapusPinjam{{ $row->id }}">
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
                    <div class="float-right">
                      {{ $pinjam->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


      <!-- Modal -->
      @foreach($pinjam as $row)
        <div class="modal fade" id="modalpinjam{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                           <th class="table-active">ID Anggota</th>
                           <td>{{ $row->id_anggota }}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Nama Peminjam</th>
                           <td>{{ $row->nama_peminjam }}</td>
                       </tr>
                        <tr>
                           <th class="table-active">Kelas</th>
                           <td>{{ $row->kelas }}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Judul Buku</th>
                           <td>{{ $row->judul_buku }}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Tanggal Pinjam</th>
                           <td>{{ date('l, d m Y', strtotime($row->tgl_pinjam ))}}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Tanggal Kembali</th>
                           <td>{{ date('l, d m Y', strtotime($row->tgl_pinjam ))}}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Status</th>
                           <td><div class="badge @if($row->status == 'Dipinjam') badge-primary  @elseif($row->status == 'Belum diambil') badge-secondary @elseif($row->status == 'Dikembalikan') badge-success @elseif($row->status == 'Denda') badge-danger @endif" style="font-weight: 450 !important;">{{ $row->status }}</div></td>
                       </tr>
                       <tr>
                           <th class="table-active">Denda</th>
                           <td>{{ $row->denda }}</td>
                       </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalEdit{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pinjam.update', $row->id) }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    @method('put')
                    @if($row->id_anggota != 'Bukan Anggota')
                      <input type="hidden" name="{{ $row->id_anggota }}" name="anggota">
                    @endif
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori">Status Pinjaman</label>
                            <select class="form-control" name="status">
                              <option value="{{ $row->status }}" selected disabled>{{ $row->status }}</option>
                              <option value="Belum diambil">Belum diambil</option>
                              <option value="Dipinjam">Dipinjam</option>
                              <option value="Dikembalikan">Dikembalikan</option>
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
      @endforeach

      <div class="modal fade" id="modalCetak" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Cetak Pinjaman Per Tanggal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="{{ route('cetakdata') }}" method="get" >
              <div class="form-group mb-4">
                <label for="date">Dari Tanggal</label>
                <input type="date" class="form-control" id="dari" name="dari" data-date-format="DD MMMM YYYY"  onchange="dari(this.value)" required autofocus>
              </div>
              <div class="form-group mb-4">
                <label for="date">Sampai Tanggal</label>
                <input type="date" class="form-control" name="sampai"  id="sampaiTanggal" required autofocus>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
               <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i> Cetak</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script type="module" src="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/duet.esm.js"></script>
        <script nomodule src="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/duet.js"></script>
        <script>
          $(".hapusPinjam").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Pinjam',
                  content: 'Apakah yakin akan tetap mengahapus?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusPinjam${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });
          
        document.getElementById("dari").max = "{{ date('Y-m-d') }}";
        document.getElementById("dari").dateFormat = "dd/mm/yyyy"

        function dari(val){
          document.getElementById("sampaiTanggal").min = val;
            
        }

           @if(!$pinjam->count())
              $('tbody').html('<td>&nbsp;</td><td>&nbsp;</td><td><h5 class="text-center text-muted pt-3 mx-auto px-auto">Belum ada pinjaman</h5></td>');
           @endif

        </script>
      @endsection
@endsection