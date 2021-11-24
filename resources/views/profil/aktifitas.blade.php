@extends('profil.layout.main')

@section('main')
          <div class="section-body">
            <h2 class="section-title">Aktifitas</h2>
            <div class="row">
              <div class="col-12">
                <div class="activities">
                    @if($aktifitas->count() < 1)
                        <p>Belum ada aktifitas</p>
                    @endif
                  @foreach($aktifitas as $row)
                  <div class="activity">
                    <div class="activity-icon {{ $row->background }} text-white shadow-primary">
                      <i class="{{ $row->icon }}"></i>
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job text-primary">{{ $row->created_at->diffForhumans() }}</span>
                        <span class="bullet"></span>
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <form action="{{ route('aktifitasus', $row->id) }}" method="POST">
                                @csrf
                                <button href="#" class="dropdown-item has-icon text-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                          </div>
                        </div>
                      </div>
                      <p>{{ $row->notifikasi }}</p>
                    </div>
                  </div>
                  @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
      @section('script')
        <script>
          $('.card').removeClass('card');
      </script>
      @endsection
@endsection