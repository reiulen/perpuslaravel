@extends('layout.main')

@section('content')

<section class="page-profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                    <div class="float-right">
                        <a href="{{ route('index') }}" class="btn btn-outline-primary">Kembali</a>
                    </div>
                <div class="row">
                    <img src="{{ asset('storage/'.$user->foto) }}" class="img-thumbnail rounded-circle" style="height: 70px">
                    <div class="nama-user mx-2 py-3">
                        <h5 class="p-0 m-0">{{ $user->nama }}</h5>
                        <span class="text-muted m-0 p-0">{{ $user->email }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-5">
                        <div class="list-group mt-3 table-hover" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action {{ ($title == 'Profile') ? 'active text-white' : '' }}" href="{{ route('profile') }}">Profile</a>
                            <a class="list-group-item list-group-item-action {{ ($title == 'Pinjaman') ? 'active text-white' : '' }}" href="{{ route('pinjamanuser') }}">Pinjaman</a>
                            <a class="list-group-item list-group-item-action {{ ($title == 'Aktifitas') ? 'active text-white' : '' }}" href="{{ route('aktifitas') }}">Aktifitas</a>
                        </div>
                    </div>
                    <div class="col-md-8 py-3 mt-3 card">
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection