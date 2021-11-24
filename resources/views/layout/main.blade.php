<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title }}</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/perpustakaan.css') }}">
  @yield('css')
  
</head>
<script>
    window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY);
  });

</script>

<body>
  
<header class="main-header fixed-top">
    <div class="container">
        <div class="row py-3">
            <div class="col-md-2 col-sm-2 col-2 d-none d-sm-inline-block">
                <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('e-perpus.png') }}" style="width: 150px"></a>
            </div>
            <div class="col-md-6 col-sm-8 col-10 d-dm-inline-block mx-auto pt-1">
              <form class="form-search" action="{{ route('search') }}" method="get">
                 @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                  @endif
                <div class="search-element">
                  <input type="text" value="{{ request('q') }}" class="form-control search-input" name="q" placeholder="Cari buku" aria-label="Cari" aria-describedby="basic-addon1">
                  <button class="btn btn-primary shadow-none btn-search"><i class="fa fa-search"></i></button>
                  <div class="search-backdrop"></div>
                </div>
              </form>
            </div>
            <div class="col-sm-2 d-sm-inline-block d-none">
                <div class="d-flex">
                @if(Auth::guard('anggota')->user())
                <button class="btn btn-none nav-link notification-toggle nav-link-lg pt-2" data-toggle="dropdown"><i class="far fa-bell mt-1" style="font-size: 20px"></i></button>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                  <div class="dropdown-header">Notifications
                  </div>
                  <div class="dropdown-list-content dropdown-list-icons">
                      @foreach(App\Models\Aktifitas::where(['user_id' => Auth::guard('anggota')->user()->id])->limit(10)->latest()->get() as $row)
                        <a href="{{ route('aktifitas') }}" class="dropdown-item link">
                          <div class="dropdown-item-icon {{ $row->background }} text-white">
                            <i class="{{ $row->icon }}"></i>
                          </div>
                          <div class="dropdown-item-desc">
                            {{ $row->notifikasi }}
                            <div class="time">{{ $row->created_at->diffForHumans() }}</div>
                          </div>
                        </a>
                      @endforeach
                       @if(App\Models\Aktifitas::where(['user_id' => Auth::guard('anggota')->user()->id])->count()== 0)
                         <p class="text-center text-muted my-5">Belum ada notifikasi</p>
                        @endif
                  </div>
                  <div class="dropdown-footer text-center">
                    <a href="{{ route('aktifitas') }}" class="link">View All <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                @endif
                    @if(Auth::guard('anggota')->user())
                      <li class="dropdown" style="list-style: none !important"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle">
                        
                        <div class="d-none d-sm-inline-block text-dark"><img src="{{ asset(Auth::guard('anggota')->user()->foto) }}" class="rounded-circle border-0" style="height: 35px;"></div></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <div class="dropdown-title">Hai, {{ Auth::guard('anggota')->user()->nama }}</div>
                          <a href="{{ route('profile') }}" class="dropdown-item has-icon link">
                            <i class="far fa-user"></i> Profile
                          </a>
                          <a href="{{ route('pinjamanuser', Auth::guard('anggota')->user()->email) }}" class="dropdown-item has-icon link">
                            <i class="fas fa-book-reader"></i> Pinjaman
                          </a>
                          <a href="{{ route('aktifitas') }}" class="dropdown-item has-icon link">
                            <i class="fas fa-bolt"></i> Aktifitas
                          </a>
                          <a href="features-settings.html" class="dropdown-item has-icon link">
                            <i class="fas fa-lock"></i> Ubah Password
                          </a>
                          <div class="dropdown-divider"></div>
                            <a href="{{ route('logoutuser', Auth::guard('anggota')->user()->id) }}" class="btn btn-none dropdown-item has-icon text-danger link">
                              <i class="fas fa-sign-out-alt pt-1"></i> Logout
                            </a>
                        </div>
                      </li>
                      @else
                      <a href="{{ route('login.index') }}"><button class="btn btn-outline-primary mx-2 mt-2">Masuk</button></a>
                      <a href="{{ route('daftar.index') }}"><button class="btn btn-primary mt-2">Daftar</button></a>
                    @endif
                </div>
            </div>
            <div class="col-2 d-sm-none d-block mx-auto pt-1">
                <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-align-justify"></i></button>
            </div>
        </div>
    </div>
</header>

@yield('content')

<div class="modal fade bd-example-modal-lg p-0 m-0" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h3>Menu</h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      <div class="modal-body">
          <div class="row">
             @if(!Auth::guard('anggota')->user())
              <div class="col-6">
                   <a href="{{ route('login.index') }}"><button class="btn btn-outline-primary btn-block">Masuk</button></a>
              </div>
              <div class="col-6">
                    <a href="{{ route('daftar.index') }}"><button class="btn btn-primary btn-block">Daftar</button></a>
              </div>
              @else
              <img src="{{ asset('storage/'.Auth::guard('anggota')->user()->foto) }}" class="rounded-circle mx-3" style="height: 40px">
              <h5 style="font-weight: 400" class="my-auto">{{ Auth::guard('anggota')->user()->nama }}</h5>
             @endif
          </div>
          <hr>
          <a class="nav-link" href="{{ route('index') }}"> <h5><i class="fa fa-home"></i> Home</h5></a>
      </div>
    </div>
  </div>
</div>
  <footer class="bg-white">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <img src="{{ asset('e-perpus.png') }}" style="height: 50px; padding-bottom:5px;">
            <p>E-Perpus adalah website perpustakaan SMKN 1 Ciamis yang memudahkan para siswa untuk meminjam buku hanya dengan sekali klik dan mengambilnya tinggal langsung data ke perpustkaan</p>
          </div>
          <div class="col-sm-3 ">
             <h4>Menu</h4>
            <ul>
              <li><a href="{{ route('index') }}">Home</a></li>
              <li><a href="#">Tentang</a></li>
              <li><a href="#">Kontak</a></li>
            </ul>
          </div>
          <div class="col-sm-3">
             <h4>Kategori</h4>
            <ul>
              @foreach(App\Models\Kategori::latest()->get() as $row)
                <li><a href="{{ route('kategori',$row->kategori) }}">{{ $row->kategori }}</a></li>
              @endforeach
            </ul>
          </div>
          <div class="col-sm-3">
            <h4>Kontak</h4>
            <ul>
              <li><i class="fas fa-envelope pe-1"></i><a href="mailto:surat@smkn1cms.net"> surat@smkn1cms.net</a></li>
              <li><i class="fas fa-phone pe-1"></i><a href="phoneto:+62-265-771204"> +62-265-771204</a></li>
              <li><i class="fas fa-map-marker-alt px-1"></i>Jl. Jend. Sudirman Lingk. Cibeureum No.269</li>
            </ul>
          </div>
        </div>
      </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if(session('alert'))
  <script>
    const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    iconColor: 'green',
                    timer: 3000,
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: '{{ session('alert') }}',
                    title: '{{ session('title') }}',
                });  
  </script>
  @endif
  @yield('script')

</body>
</html>