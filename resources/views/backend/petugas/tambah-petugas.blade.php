@extends('backend.layout.main')

@section('content')
     <div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
            <a href="{{ route('petugas.index') }}" class="btn btn-outline-primary px-3"><i class="fas fa-arrow-left"></i></a>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item active"><a href="{{ url('/admin/petugas') }}">Petugas</a></div>
              <div class="breadcrumb-item">Tambah Petugas</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tambah Petugas</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('petugas.store') }}" method="POST" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Id Petugas</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="read" name="id-petugas" value="PEP{{ date('dmY', strtotime(now())) }}{{ $user->max('id') }}" class="form-control" readonly>
                            </div>
                            </div>
                            <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="namaL"  value="{{ old('nama') }}"  name="nama" class="form-control" required autofocus>
                                <div class="invalid-feedback">
                                    Nama Lengkap belum diisi!
                                </div>
                                <div id="valnama"></div>
                            </div>
                            </div>
                            <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="username" value="{{ old('username') }}" name="username" id="username" class="form-control" required autofocus>
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
                            <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="password" id="password"  value="{{ old('password1') }}"  name="password1" class="form-control" required autofocus>
                                <div class="invalid-feedback">
                                    Password belum diisi!
                                </div>
                                 @error('password1')
                                    <div class="text-small text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div id="kon1"></div>
                            </div>
                            </div>
                            <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi Password</label>
                              <div class="col-sm-12 col-md-6">
                                  <input type="password" id="password2"  value="{{ old('password2') }}"  name="password2" class="form-control" required autofocus>
                                  <div class="invalid-feedback">
                                      Konfirmasi Password belum diisi!
                                  </div>
                                  @error('password2')
                                      <div class="text-small text-danger">
                                          {{ $message }}
                                      </div>
                                  @enderror
                                  <div id="kon2"></div>
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
          @if(session('alert'))
            iziToast.{{ session('alert') }}({
              title: '{{ session('pesan') }}',
              position: 'topRight'
            });
          @endif
       </script>
      @endsection
@endsection