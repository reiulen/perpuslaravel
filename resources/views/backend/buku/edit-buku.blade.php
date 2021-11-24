@extends('backend.layout.main')

@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/summernote/summernote.css') }}">
@endsection
    <div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
              <a href="{{ route('buku.index') }}" class="btn btn-outline-primary px-3"><i class="fas fa-arrow-left"></i></a>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item active"><a href="{{ url('/admin/buku') }}">Buku</a></div>
              <div class="breadcrumb-item">Edit Buku</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Buku</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('buku.update', $data->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                        @csrf
                        @method('put')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Buku</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="j_buku" name="judul_buku" value="{{ $data->judul_buku }}" class="form-control @error('judul_buku') is-invalid  @enderror" required autofocus>
                               @error('judul_buku')
                                <div class="invalid-feedback ">
                                    Judul {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pengarang</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="pengarang" name="pengarang"  value="{{ $data->pengarang }} "  class="form-control @error('pengarang') is-invalid  @enderror" required autofocus>
                                @error('pengarang')
                                <div class="invalid-feedback ">
                                    Pengarang {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >Jumlah Buku</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="number" id="jumlah_buku" name="jumlah_buku"  value="{{ $data->jumlah_buku }}" class="form-control @error('jumlah_buku') is-invalid  @enderror" required autofocus>
                                @error('jumlah_buku')
                                <div class="invalid-feedback ">
                                    Jumlah buku {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun Terbit</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="number" id="tahun_terbit" name="tahun_terbit"  value="{{ $data->tahun_terbit }}"  class="form-control @error('tahun_terbit') is-invalid  @enderror" required autofocus>
                                @error('tahun_terbit')
                                <div class="invalid-feedback ">
                                    Tahun terbit {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penerbit</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="penerbit" name="penerbit"  value="{{ $data->penerbit }}" class="form-control @error('penerbit') is-invalid  @enderror" required autofocus>
                                @error('penerbit')
                                <div class="invalid-feedback ">
                                    Penerbit {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">ISBN</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="isbn" name="isbn"  value="{{ $data->isbn }}"  class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                            <div class="col-sm-12 col-md-6">
                               <select class="form-control @error('kategori_id') is-invalid  @enderror" name="kategori_id" required autofocus>
                                    <option value="{{ $data->kategori_id }}" selected>{{ $data->kategori->kategori }}</option>
                                    @foreach($kategori as $row)
                                        <option value="{{ $row->id }}">{{ $row->kategori }}</option>
                                    @endforeach
                               </select>
                               @error('kategori')
                                <div class="invalid-feedback ">
                                    Kategori {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                            <div class="col-sm-12 col-md-6">
                                <select name="status" class="form-control">
                                    <option value="{{ $data->status }}" selected>{{ $data->status }}</option>
                                    <option value="Publish">Publish</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Draft">Draft</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                            <div class="col-sm-12 col-md-6">
                               <textarea name="deskripsi" value="{{ $data->deskripsi }}" id="deskripsi" class="form-control @error('deskripsi') is-invalid  @enderror " required autofocus>{{ $data->deskripsi }}</textarea>
                               @error('deskripsi')
                                <div class="invalid-feedback ">
                                    Deskripsi {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="text-md-right col-12 col-md-3 col-lg-3" for="customFile">Gambar</label>
                            <div class="col-md-3">
                                <img src="{{ asset('storage/'.$data->gambar_buku); }}" class="img-thumbnail img-preview">
                                @error('gambar')
                                    {{ $message }}
                                @enderror
                                <p class="text-small text-danger pt-2">*Gambar maksimum 2mb</p>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <input type="file" onchange="gambarpreview()" class="custom-file-input gambar-file" name="gambar_buku"  id="customFile">
                                <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                            </div>
                        </div>
                            <div class="form-group row my-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-6 text-center">
                                  <button type="submit" class="btn btn-primary col-5">Edit</button>
                              </div>
                            </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
    </div>

      @section('script')
        <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
        <script>
        function gambarpreview(){
            const sampul = document.querySelector('#customFile');
            const preview = document.querySelector('.img-preview');

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e){
              preview.src = e.target.result;
            }
        }
         ClassicEditor.create(document.querySelector('#deskripsi'));
        </script>
      @endsection
@endsection