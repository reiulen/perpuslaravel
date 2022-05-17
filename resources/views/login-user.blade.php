@extends('layout.main')
@section('content')
    <section class="section" style="background: transparent !important; margin-top:100px;">
      <div class="container my-5">
        <div class="row">
          <div class="col-12 col-sm-10 col-md-4 col-lg-4 col-xl-4 header-register my-5 offset-md-1 ">

          @if(session('title'))
            <div class="alert alert-primary" role="alert" style="font-weight: 400 !important;">
              <b style="font-weight: 500 !important">Anggota berhasil didaftarkan</b>, silahkan cek email untuk verifikasi jika tidak ada silahkan untuk cek spam!.
            </div>
          @endif
            <div class="card card-primary ">
              <div class="card-header"><h5>Masuk Anggota E-Perpus</h5></div>
              <div class="card-body pt-0">
                
                <form method="POST" action="{{ route('login.store') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="nama">Email</label>
                    <input type="email" class="form-control" name="email" required autofocus>
                        @if(session('email'))
                          <p class="text-small text-danger">{{ session('email') }}</p>
                        @endif
                        <div class="invalid-feedback text-small">
                          *Email Belum Diisi !
                        </div>
                  </div>

                    <div class="form-group">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" name="password" class="form-control" required autofocus>
                          <p class="text-danger text-small"></p>
                          @if(session('password'))
                            <p class="text-small text-danger">{{ session('password') }}</p>
                          @endif
                          <div class="invalid-feedback text-small">
                            *Password Harus Diisi !
                          </div>
                    </div>
                  <div class="form-group text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                      Masuk
                    </button>
                  </div>
                </form>
                  <div class="text-center">
                    <a class="p-1" href="">Lupa password?</a><br>
                    Belum punya akun?<a class="p-1" href="{{ route('daftar.index') }}">Daftar</a>
                  </div>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy;Community @2021
            </div>
          </div>
          <div class="col-md-7 d-none d-md-block mt-0 pt-0 text-center">
            <h1 class="text-primary mb-0 pb-0">Meminjam buku Perpustakaan<br> dengan kemudahan</h1>
            <img src="{{ asset('assets/img/login.svg') }}" class="mt-0 pt-0" height="450">
          </div>
        </div>
      </div>
    </section>

  @endsection