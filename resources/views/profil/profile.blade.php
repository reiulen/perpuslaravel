@extends('profil.layout.main')

@section('main')
    
                    @error('nis')
                        {{ $message }}
                    @enderror
                        <h4 class="py-1">Profile</h4>
                        <hr class="p-0 m-0">
                        <div class="row px-3 py-4">
                            <div class="col-lg-4 col-md-12 mt-3 float-left text-center">
                                <p>Foto profil</p>
                                <img src="{{ $user->foto }}" class="rounded-circle" style="height: 200px">
                                <button type="button" class="btn btn-primary my-2" style="font-weight: 400 !important;" data-toggle="modal" data-target="#updateFoto">
                                    Ubah foto
                                </button>
                            </div>
                             <div class="col-lg-8 col-md-12">
                                <div class="form-group mb-4">
                                    <label for="Nama">Id Anggota</label>
                                    <p class="form-control" style="background-color:rgb(214, 214, 214) !important;">{{ $user->id_anggota }}</p>
                                </div>
                                <form action="{{ route('profil', $user->id) }}" method="POST" class="needs-validation" novalidate="">
                                    @csrf
                                    <input type="hidden" name="a" value="a">
                                    <div class="form-group mb-4">
                                    <label for="Nama">Nama</label>
                                    <input type="text" value="{{ $user->nama }}" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            *Nama {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="nis">NIS</label>
                                    <input type="text" value="{{ $user->nis }}" name="nis" id="idnis" class="form-control @error('nis') is-invalid @enderror" required>
                                     @error('nis')
                                        <div class="invalid-feedback">
                                            *Nis {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="Nama">Kelas</label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="kelas">
                                        <option value="{{ $user->kelas }}" selected >--{{ $user->kelas }}--</option>
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
                                </div>
                                <div class="form-group mb-4">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                        <option value="{{ $user->jenis_kelamin }}" selected>--{{ $user->jenis_kelamin }}--</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary col-md-6">Ubah Profil</button>
                                </div>
                                </form>
                            </div>
                        </div>

                        <div class="modal fade" id="updateFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Ubah foto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('profil', $user->id) }}" enctype="multipart/form-data" method="POST" >
                                @csrf
                                <div class="modal-body">
                                    <div class="foto-user text-center mb-3">
                                        <img src="{{ asset('storage/'.$user->foto); }}" class="img-thumbnail img-preview rounded-circle" style="height: 200px">
                                    </div>
                                    <span class="text-small text-danger p-3">*Max upload gambar 2MB</span>
                                    <input type="file" onchange="gambarpreview()" class="form-control gambar-file" name="foto"  id="customFile">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            </div>
                        </div>
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
                                 $("#idnis").keypress(function(e) {
                                        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                                            return false;
                                        }
                                    });	
                             </script>
                        @endsection

@endsection