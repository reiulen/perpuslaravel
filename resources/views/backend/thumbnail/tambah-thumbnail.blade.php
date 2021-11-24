@extends('backend.layout.main')

@section('content')
         <div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
             <a href="{{ route('thumbnail.index') }}" class="btn btn-outline-primary px-3"><i class="fas fa-arrow-left"></i></a>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item active"><a href="{{ url('/admin/petugas') }}">Thumbnail</a></div>
              <div class="breadcrumb-item">Tambah Thumbnail</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tambah Thumbnail</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('thumbnail.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="link" name="link" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="text-md-right col-12 col-md-3 col-lg-3" for="customFile">Gambar</label>
                            <div class="col-md-3">
                                <img src="{{ asset('gambar.jpg'); }}" class="img-thumbnail img-preview">
                                @error('gambar')
                                    <div class="invalide-feedback">
                                      {{ $message }}
                                    </div>
                                @enderror
                                <p class="text-small text-danger pt-2">*Gambar maksimum 2mb</p>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <input type="file" onchange="gambarpreview()" class="custom-file-input gambar-file @error('gambar') is-invalid @enderror" name="gambar"  id="customFile" required autofocus>
                                <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                            </div>
                        </div>
                            <div class="form-group row my-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-6 text-center">
                                  <button type="submit" class="btn btn-primary col-5">Tambah</button>
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
        </script>
      @endsection
@endsection