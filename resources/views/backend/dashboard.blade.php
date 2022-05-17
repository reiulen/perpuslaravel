@extends('backend.layout.main')
@section('content')
  @section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel/owl.theme.default.min.css') }}"/>
  @endsection
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row py-3">
            <div class="col-lg-6" style="border-radius: 12px;">
                <div class="owl-carousel owl-theme slider" id="slider1">
                  @foreach($thumbnail as $row)
                    <div><img src="{{ asset('storage/'.$row->gambar) }}" style="border-radius: 12px; height:50vh; object-fit:cover; object-postion:center;"></div>
                  @endforeach
                </div>
            </div>
            <div class="col-lg-6 pt-4">
                <div class="row">
                    @if( Auth::guard('anggota') )
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Petugas</h4>
                                </div>
                                <div class="card-body">
                                    {{ $petugas->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Anggota Aktif</h4>
                                </div>
                                <div class="card-body">
                                    {{ $anggota->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-book text-white"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Buku</h4>
                            </div>
                            <div class="card-body">
                                {{ $buku->count() }}
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-book-reader"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Pinjaman</h4>
                                </div>
                                <div class="card-body">
                                    {{ $pinjaman->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Buku Paling Banyak Dikunjungi</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="ChartBukuPopuler"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Buku Paling Banyak Dipinjam</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="ChartPinjaman"></canvas>
                  </div>
                </div>
              </div>
            <div class="col-lg-4 col-md-6 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Anggota Baru</h4>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled list-unstyled-border">
                    @foreach(App\Models\Anggota::latest()->limit(5)->get() as $row)
                    <li class="media">
                      <img class="mr-3 rounded-circle" width="50" src="{{ asset('storage/'.$row->foto) }}" alt="avatar">
                      <div class="media-body">
                        <div class="float-right text-primary">{{ $row->created_at->diffForhumans() }}</div>
                        <div class="media-title">{{ $row->nama }}</div>
                        <span class="text-small text-muted">{{ $row->email }}</span>
                      </div>
                    </li>
                    @endforeach
                    @if(App\Models\Anggota::count() == 0)
                      <li class="media">
                        <p>Belum ada anggota</p>
                      </li>
                    @endif
                  </ul>
                  <div class="text-center pt-1 pb-1">
                    <a href="{{ route('anggota') }}" class="btn btn-primary btn-lg btn-round">
                      View All
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Petugas Baru</h4>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled list-unstyled-border">
                    @foreach(App\Models\User::where('role', 'Petugas')->latest()->limit(5)->get() as $row)
                    <li class="media">
                      <img class="mr-3 rounded-circle" width="50" src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="avatar">
                      <div class="media-body">
                        <div class="float-right text-primary">{{ $row->created_at->diffForhumans() }}</div>
                        <div class="media-title">{{ $row->nama }}</div>
                        <span class="text-small text-muted">{{ $row->id_petugas }}</span>
                      </div>
                    </li>
                    @endforeach
                    @if(App\Models\User::where('role', 'Petugas')->count() == 0)
                      <li class="media">
                        <p>Belum ada petugas</p>
                      </li>
                    @endif
                  </ul>
                  <div class="text-center pt-1 pb-1">
                    <a href="{{ route('petugas.index') }}" class="btn btn-primary btn-lg btn-round">
                      View All
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Pinjaman Baru</h4>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled list-unstyled-border">
                    @foreach(App\Models\Pinjaman::with(['buku'])->latest()->limit(5)->get() as $row)
                    <li class="media">
                      <img class="mr-3" width="50" src="{{ asset('storage/'.$row->buku->gambar_buku) }}" alt="avatar">
                      <div class="media-body">
                        <div class="float-right text-primary">{{ $row->created_at->diffForhumans() }}</div>
                        <div class="media-title">{{ $row->judul_buku }}</div>
                        <span class="text-small text-muted">{{ $row->nama_peminjam }}</span>
                      </div>
                    </li>
                    @endforeach
                    @if(App\Models\Pinjaman::count() == 0)
                      <li class="media">
                        <p>Belum ada pinjaman</p>
                      </li>
                    @endif
                  </ul>
                  <div class="text-center pt-1 pb-1">
                    <a href="{{ route('pinjam.index') }}" class="btn btn-primary btn-lg btn-round">
                      View All
                    </a>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
        </section>
      </div>
      @section('script')
        <script src="{{ asset('assets/js/owl-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/page/chart.js') }}"></script>
        <script>
          $("#slider1").owlCarousel({
            items: 1,
            margin:10,
            dots:false,
            nav: true,
            loop:true,
            autoplayTimeout: 4000,
            autoplay: true,
            navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
          });
          $(document).ready(function(){
             var ctx = document.getElementById("ChartBukuPopuler").getContext('2d');
              var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: [@foreach($buku->limit(5)->get() as $row)"{{ $row->judul_buku }}", @endforeach],
                  datasets: [{
                    label: 'Views',
                    data: [@foreach($buku->limit(5)->get() as $row){{ $row->views }}, @endforeach],
                    backgroundColor: [
                        '#63ed7a',
                        '#ffa426',
                        '#fc544b',
                        '#6777ef',
                        '#191d21',
                    ],
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                  }]
                },
                options: {
                  legend: {
                    display: false
                  },
                  scales: {
                    yAxes: [{
                      gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                      },
                      ticks: {
                        beginAtZero: true,
                        stepSize: 150
                      }
                    }],
                    xAxes: [{
                      ticks: {
                        display: false
                      },
                      gridLines: {
                        display: false
                      }
                    }]
                  },
                }
              });
              var ctx = document.getElementById("ChartPinjaman").getContext('2d');
              var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                  labels: [@foreach(App\Models\Buku::orderByDesc('pinjaman')->limit(5)->get() as $row)"{{ $row->judul_buku }}", @endforeach],
                  datasets: [{
                    label: 'Statistik',
                    data: [@foreach(App\Models\Buku::orderByDesc('pinjaman')->limit(5)->get()  as $row){{ $row->pinjaman }}, @endforeach],
                    backgroundColor: [
                        '#63ed7a',
                        '#ffa426',
                        '#fc544b',
                        '#6777ef',
                        '#191d21',
                    ],
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                  }]
                },
                options: {
                  legend: {
                    display: false
                  },
                  scales: {
                    yAxes: [{
                      gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                      },
                      ticks: {
                        beginAtZero: true,
                        stepSize: 150
                      }
                    }],
                    xAxes: [{
                      ticks: {
                        display: false
                      },
                      gridLines: {
                        display: false
                      }
                    }]
                  },
                }
              });
          });
        </script>
      @endsection
@endsection