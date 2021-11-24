@extends('backend.layout.main')

@section('content')
     <div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
             <a href="{{ route('petugas.index') }}" class="btn btn-outline-primary px-3"><i class="fas fa-arrow-left"></i></a>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item active"><a href="{{ url('/admin/petugas') }}">Petugas</a></div>
              <div class="breadcrumb-item">Edit Petugas</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Petugas</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('petugas.update', $petugas->id) }}" method="POST" class="needs-validation" novalidate="">
                        @csrf
                        @method('put')
                            <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="namaL" value="{{ $petugas->nama }}" name="nama" class="form-control" required autofocus>
                                <div class="invalid-feedback">
                                    Nama Lengkap belum diisi!
                                </div>
                                <div id="valnama"></div>
                                @error('nama')
                                    <div class="text-small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>
                            <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" value="{{ $petugas->username }}" name="username" id="username" class="form-control" required autofocus>
                                <div class="invalid-feedback">
                                    Username belum diisi!
                                </div>
                                @error('username')
                                    <div class="text-small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div id="valusername"></div>
                            </div>
                            </div>
                            <div class="form-group row my-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-6 text-center">
                                  <button type="submit" class="btn btn-primary col-5">Edit</button>
                              </div>
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
@endsection