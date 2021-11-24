@extends('backend.layout.main')

@section('content')
    @section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection
<div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="">Admin</a></div>
              <div class="breadcrumb-item">Thumbnail</div>
            </div>
          </div>

          <div class="section-body">
            <h1 class="section-title">Thumbnail</h1>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                      <a href="{{ route('thumbnail.create') }}" class="link">
                        <button class="btn btn-primary mb-3"><i class="fa fa-edit"></i> Tambah Thumbnail</button>
                      </a>
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-petugas">
                        <thead>
                          <tr>
                            <th class="text-center">
                              No
                            </th>
                            <th>Gambar</th>
                            <th>Link</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                           @if($thumbnail)
                            @php
                                $i = 1;
                             @endphp
                            @foreach($thumbnail as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="py-3"><img src="{{ asset('storage/'.$row->gambar) }}" class="img-thumbnail" style="height: 200px;"></td>
                                <td>{{ $row->link }}</td>
                                <td>
                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v" type="button" id="thumbnaildrop{{ $row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="thumbnaildrop{{ $row->id }}">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modalthumbnail{{ $row->id }}" href="#"><i class="fa fa-eye"></i> Lihat Detail</a>
                                            <a class="dropdown-item hapusThumbnail" data-id="{{ $row->id }}" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                            <form action="{{ route('thumbnail.destroy', $row->id) }}" method="POST" id="hapusThumbnail{{ $row->id }}">
                                              @csrf
                                              @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <h1 class="text-center">Belum ada thumbnail</h1>
                           @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
        </section>
      </div>


      <!-- Modal -->
       @foreach($thumbnail as $row)
        <div class="modal fade" id="modalthumbnail{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/'.$row->gambar) }}" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                </div>
                </div>
            </div>
        </div>
       @endforeach
      @section('script')
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script>
          $(".hapusThumbnail").click(function(e){
              id = e.target.dataset.id;
              $.confirm({
                  title: 'Hapus Thumbnail',
                  content: 'Apakah yakin akan tetap mengahapus?',
                  type: 'red',
                  autoClose: 'cancel|8000',
                  buttons: {
                      deleteUser: {
                          text: 'Hapus',
                          btnClass: 'btn-red',
                          action: function () {
                            $(`#hapusThumbnail${id}`).submit();
                          }
                      },
                      cancel: function () {
                        
                      }
                  }
              });
          });
          
        </script>
      @endsection
@endsection