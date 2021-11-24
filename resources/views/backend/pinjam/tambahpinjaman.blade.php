@extends('backend.layout.main')

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header bg-transparent shadow-none pb-0">
              <a href="{{ route('pinjam.index') }}" class="btn btn-outline-primary px-3"><i class="fas fa-arrow-left"></i></a>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Admin</a></div>
              <div class="breadcrumb-item active"><a href="{{ url('/admin/buku') }}">Pinjaman</a></div>
              <div class="breadcrumb-item">Tambah Pinjaman</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tambah Pinjaman</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('pinjam.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pinjaman Untuk</label>
                            <div class="col-sm-12 col-md-6">
                                <select class="form-control" onchange="getval(this);"  name="jenis_pinjaman" required autofocus>
                                    <option disabled selected>--Pilih peminjam--</option>
                                    <option value="anggota">Anggota</option>
                                    <option value="bukananggota">Bukan Anggota</option>
                                </select>
                                @error('anggota')
                                <div class="invalid-feedback ">
                                    Pengarang {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group d-none row mb-4" id="idanggota">
                            <label for="idanggotaselect" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Id Anggota</label>
                            <div class="col-sm-12 col-md-6">
                            <select  id="select" class="form-control form-select @error('id_anggota') is-invalid  @enderror" required autofocus>
                                    <option disabled selected>--Pilih peminjam--</option>
                                     @foreach($anggota as $row)
                                        <option value="{{ $row->id }}">{{ $row->id_anggota }} {{ $row->nama }}</option>
                                    @endforeach
                            </select>
                               @error('id_anggota')
                                <div class="invalid-feedback ">
                                    Id Anggota {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group d-none row mb-4" id="nama">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="inputnama" class="form-control @error('nama') is-invalid  @enderror" required autofocus>
                               @error('nama')
                                <div class="invalid-feedback ">
                                    Nama {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group d-none row mb-4" id="email">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" id="inputemail" class="form-control @error('email') is-invalid  @enderror" required autofocus>
                                 @error('email')
                                <div class="invalid-feedback ">
                                    Email{{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group d-none row mb-4" id="j_kelamin">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                            <div class="col-sm-12 col-md-6">
                                <select id="jenis_kelamin" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                 @error('email')
                                <div class="invalid-feedback ">
                                    Jenis kelamin{{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Buku</label>
                            <div class="col-sm-12 col-md-6">
                                <select  id="select2" name="judul_buku" class="form-control form-select @error('judul_buku') is-invalid  @enderror" required autofocus>
                                    <option disabled selected>--Pilih judul buku--</option>
                                     @foreach($buku as $row)
                                        <option value="{{ $row->id }}">{{ $row->judul_buku }}</option>
                                    @endforeach
                                </select>
                                @error('judul_buku')
                                <div class="invalid-feedback ">
                                    Judul buku {{ $message }}
                                </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4 d-none" id="kelasselect">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >Kelas</label>
                            <div class="col-sm-12 col-md-6">
                               <select class="form-control @error('kelas') is-invalid @enderror" id="kelas"  required autofocus>
                                    <option selected disabled>--Pilih Kelas--</option>
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
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                            <div class="col-sm-12 col-md-6">
                                <select  name="status" class="form-control form-select @error('status') is-invalid  @enderror" required autofocus>
                                    <option disabled selected>--Pilih status--</option>
                                    <option value="Belum diambil">Belum diambil</option>
                                    <option value="Dipinjam">Dipinjam</option>
                                </select>
                                 @error('status')
                                <div class="invalid-feedback text-small">
                                    {{ $message }}
                                </div>
                                 @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Pinjam</label>
                            <div class="col-sm-12 col-md-6">
                               <input type="date" class="form-control col-sm-8" name="tgl_pinjam" data-date-format="DD MMMM YYYY"  onchange="tgl_awal(this.value)" id="tgl_pinjam">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Pengembalian</label>
                            <div class="col-sm-12 col-md-6">
                                <input type="date" class="form-control col-sm-8" name="tgl_kembali" id="tgl_akhir">
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>

        document.getElementById("tgl_pinjam").min = "{{ date('Y-m-d') }}";
        document.getElementById("tgl_pinjam").dateFormat = "dd/mm/yyyy"

        function tgl_awal(val){
            document.getElementById("tgl_akhir").min = val;
            
        }

        let value = $('#tgl_awal').val();
        $('#value').val(value);

         $('#select').select2({
            placeholder: 'Select an option'
         });
         $('#select2').select2({
            placeholder: 'Select an option'
         });
         $('#kelas').select2({
            placeholder: 'Select an option'
         });
        function getval(sel) {
          if(sel.value == 'anggota'){
              $('#idanggota').removeClass('d-none');
              $('#nama').addClass('d-none');
              $('#email').addClass('d-none');
              $('#j_kelamin').addClass('d-none');
              $('#kelasselect').addClass('d-none');
              $('#inputnama').attr('name', '');
              $('#inputemail').attr('name', '');
              $('#jenis_kelamin').attr('name', '');
              $('#kelas').attr('name', '');
              $('#select').attr('name', 'id_anggota');
          }
          if(sel.value == 'bukananggota'){
              $('#idanggota').addClass('d-none');
              $('#kelasselect').removeClass('d-none');
              $('#nama').removeClass('d-none');
              $('#j_kelamin').removeClass('d-none');
              $('#email').removeClass('d-none');
              $('#kelas').attr('name', 'kelas');
              $('#inputnama').attr('name', 'nama');
              $('#inputemail').attr('name', 'email');
               $('#jenis_kelamin').attr('name', 'jenis_kelamin');
              $('#select').attr('name', '');
          }
        }

          $("#tahun_terbit").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        </script>
      @endsection
@endsection