@extends('layout.main')
@section('content')
     <section class="section" style="background: transparent !important; margin-top:100px !important;">
      <div class="container my-5">
        <div class="row">
          <div class="col-12 col-sm-10 col-md-4 col-lg-4 col-xl-4 header-register my-5 offset-md-1 ">

            
            <div class="card card-primary ">
              <div class="card-header"><h5>Lupa Password</h5></div>
              <div class="card-body pt-0">

                <form method="POST" action="" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="nama">Email</label>
                    <input type="email" class="form-control" name="email" required autofocus>
                        <div class="invalid-feedback text-small">
                          *Email Belum Diisi !
                        </div>
                  </div>


                  <div class="form-group text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                      Kirim Email
                    </button>
                  </div>
                </form>
                  <div class="text-center">
                    Belum punya akun?<a class="p-1" href="">Daftar</a>
                  </div>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy;Community @2021
            </div>
          </div>
          <div class="col-md-7 d-none d-md-block">
              <h1 class="text-primary text-center">Meminjam buku Perpustakaan<br> dengan kemudahan</h1>
            <img src="">
          </div>
        </div>
      </div>
    </section>
@endsection