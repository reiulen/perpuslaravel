@extends('layout.main')

@section('content')
<section class="section" style="background: transparent !important; margin-top:100px !important;">
      <div class="container my-5">
        <div class="row">
          <div class="col-12 col-sm-10 col-md-6 col-lg-6 col-xl-6 header-register">

            <div class="card card-primary ">
              <div class="card-header"><h3>Daftar Anggota E-Perpus</h3></div>
              <div class="card-body">


                <form method="POST" action="{{ route('daftar.store') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input id="namaL" type="name" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" name="nama" required autofocus>
                        <div id="namaK" class="m-1 text-small"></div>
                        @error('nama')
                        <div class="invalid-feedback text-small">
                          {{ $message }}
                        </div>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" required autofocus>
                        <option selected @if(!old('kelas')) selected @endif>--Pilih Kelas--</option>
                        @if(old('kelas'))
                            <option value="{{ old('kelas') }}" selected>{{ old('kelas') }}</option>
                          @endif
                        <option value="X-Akutansi" >X Akutansi</option>
                        <option value="X-BDP" >X BDP</option>
                        <option value="X-Perkantoran" >X Perkantoran</option>
                        <option value="X-Perhotelan" >X Perhotelan</option>
                        <option value="X-Multimedia" >X MM</option>
                        <option value="X-RPL" >X RPL</option>
                        <option value="X-TataBoga" >X Tata Boga</option>
                        <option value="XI-Akutansi" >XI Akutansi</option>
                        <option value="XI-BDP" >XI BDP</option>
                        <option value="XI-Perkantoran" >XI Perkantoran</option>
                        <option value="XI-Perhotelan" >XI Perhotelan</option>
                        <option value="XI-Multimedia" >XI MM</option>
                        <option value="XI-RPL" >XI RPL</option>
                        <option value="XI-TataBoga" >XI Tata Boga</option>
                        <option value="XII-Akutansi" >XII Akutansi</option>
                        <option value="XII-BDP" >XII BDP</option>
                        <option value="XII-Perkantoran" >XII Perkantoran</option>
                        <option value="XII-Perhotelan" >XII Perhotelan</option>
                        <option value="XII-Multimedia" >XII MM</option>
                        <option value="XII-RPL" >XII RPL</option>
                        <option value="XII-TataBoga" >XII Tata Boga</option>
                    </select>
                        @error('kelas')
                        <div class="invalid-feedback text-small">
                          {{ $message }}
                        </div>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="j_kelamin">Jenis Kelamin</label>
                        <select name="j_kelamin"  class="form-control selectric @error('j_kelamin') is-invalid @enderror" required autofocus>
                          <option disabled @if(!old('password')) selected @endif>--Pilih Jenis Kelamin--</option>
                          @if(old('j_kelamin'))
                            <option value="{{ old('j_kelamin') }}" selected>{{ old('j_kelamin') }}</option>
                          @endif
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                         @error('jenis_kelamin')
                        <div class="invalid-feedback text-small">
                          {{ $message }}
                        </div>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="nama">Email</label>
                    <input id="namaL" type="email" value="{{ old('email') }}"  class="form-control @error('email') is-invalid @enderror" name="email"  required autofocus>
                        <div id="namaK" class="m-1 text-small"></div>
                         @error('email')
                        <div class="invalid-feedback text-small">
                          {{ $message }}
                        </div>
                        @enderror
                  </div>
                    <div class="form-group">
                      <label for="nis">NIS</label>
                      <input id="idnis" type="text" value="{{ old('nis') }}"  class="form-control @error('nis') is-invalid @enderror" name="nis" required autofocus>
                      <div id="konNis" class="m-1 text-danger text-small">*harap cantumkan nis yang benar!</div>
                         @error('nis')
                        <div class="invalid-feedback text-small">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" value="{{ old('password1') }}"  class="form-control pwstrength @error('password1') is-invalid @enderror" data-indicator="pwindicator" name="password1" required autofocus>
                          <div id="kon1" class="m-1 text-danger text-small"></div>
                           @error('password1')
                          <div class="invalid-feedback text-small">
                            {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Konfirmasi Password</label>
                      <input id="password2" type="password" value="{{ old('password2') }}"  class="form-control @error('password2') is-invalid @enderror" name="password2" required autofocus>
                          <div id="kon2" class="m-1 text-danger text-small "></div>
                           @error('password2')
                          <div class="invalid-feedback text-small">
                            {{ $message }}
                          </div>
                          @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required autufocus>
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                          <div id="kon2" class="m-1"></div>
                          <div class="invalid-feedback">
                            Harus Disetujui !
                          </div>
                    </div>
                  </div>

                  <div class="form-group text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg col-6">
                      Daftar
                    </button>
                  </div>
                </form>
                <div class="text-center">
                    <a class="p-1" href="">Lupa password?</a><br>
                    Sudah punya akun?<a class="p-1" href="{{ route('login.index') }}">Login</a>
                </div>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy;Community @2021
            </div>
          </div>
          <div class="col-md-6 d-none d-md-block text-center">
              <h5>Mari Memulai dengan E-Perpus</h5>
              <h2 class="text-primary" style="font-weight:bold !important;">Meminjam buku Perpustakaan<br> dengan kemudahan</h2>
            <img src="{{ asset('assets/img/daftar.svg') }}">
          </div>
        </div>
      </div>
    </section>
  </div>

    @section('script')
         <script>
        $("#namaL").keyup(function(){
            var username = $("#namaL").val();
            if(username == ''){
                $("#namaK").html("<span style='color:red'>Nama Harus Diisi</span>");
            }
        });

        $("#idnis").keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });	
       
        

        $("#username").keyup(function(){
            var username = $("#username").val();
            var jumlahkarakter = username.length;
            if(jumlahkarakter < 6){
                $("#konfirmasi").html("Username Terlalu Pendek");
            }
            else if(jumlahkarakter > 24){
                $("#konfirmasi").html("<span style='color:red'>Username Terlalu Panjang</span>");
            }
            else{
                if(username.match(/[^a-zA-Z0-9]/i))
                    $("#konfirmasi").html("<span style='color:red'>Anda memasukkan karakter yang tidak diijinkan</span>");
                else
                    $("#konfirmasi").html("<span style='color:green'>Bagus!</span>");
            }
        });

         $("#password").keyup(function(){
            var password = $("#password").val();
            var jumlahkarakter = password.length;
            if(jumlahkarakter < 8){
                $("#kon1").html("Password terlalu pendek");
            }
            else{
                $("#kon1").html("<span style='color:green'>Bagus!</span>");
            }
        });

        $("#password2").blur(function(){
            var password1 = $("#password").val();
            var password2 = $("#password2").val();
          
            if(password2 != password1){
                $("#kon2").html("Password tidak cocok");
            }
            else{
                $("#kon2").html("<span style='color:green'>Password cocok</span>");
            }
        });
      </script>
     @endsection
@endsection