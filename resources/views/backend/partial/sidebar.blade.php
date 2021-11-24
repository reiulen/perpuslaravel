
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand my-2">
            <a class="link" href="{{ url('admin/dashboard') }}"><img src="{{ asset('e-perpus.png') }}" style="width: 150px"></a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a class="link" href="{{ url('admin/dashboard') }}">EP</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="{{ ($title == 'Dashboard') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}" class="nav-link link active"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Pengelolaan User</li>
              @if(Auth()->user()->role == 'Admin')
                <li class="nav-item dropdown {{ ($title == 'Data Petugas' or $title == 'Tambah Petugas' or $title == 'Edit Petugas') ? 'active' : '' }}">
                  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-tie"></i> <span>Petugas</span></a>
                  <ul class="dropdown-menu">
                    <li {{ ($title == 'Data Petugas') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('petugas.index') }}">Data Petugas</a></li>
                    <li {{ ($title == 'Tambah Petugas') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('petugas.create') }}">Tambah Petugas</a></li>
                  </ul>
                </li>
              @endif
              <li class="nav-item dropdown {{ ($title == 'Data Anggota') ? 'active' : ' ' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-user"></i> <span>Anggota</span></a>
                <ul class="dropdown-menu">
                  <li {{ ($title == 'Data Anggota') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('anggota') }}">Data Anggota</a></li>
                  <li><a class="nav-link link" href="{{ route('daftar.index') }}">Tambah Anggota</a></li>
                </ul>
              </li>
              <li class="menu-header">Pengelolaan Buku</li>
              <li class="nav-item dropdown {{ ($title == 'Data Buku' || $title == 'Tambah Buku' || $title == 'Edit Buku' || $title == 'Kategori Buku'  ) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>Buku</span></a>
                <ul class="dropdown-menu">
                  <li {{ ($title == 'Data Buku') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('buku.index') }}">Data Buku</a></li>
                  <li {{ ($title == 'Kategori Buku') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('kategori.index') }}">Kategori</a></li>
                  <li {{ ($title == 'Tambah Buku') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('buku.create') }}">Tambah Buku</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown {{ ($title == 'Data Pinjaman' || $title == 'Tambah Pinjaman' || $title == 'Edit Pinjaman' ) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book-reader"></i> <span>Pinjaman</span></a>
                <ul class="dropdown-menu">
                  <li {{ ($title == 'Data Pinjaman') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('pinjam.index') }}">Data Pinjaman</a></li>
                  <li {{ ($title == 'Tambah Pinjaman') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('pinjam.create') }}">Tambah Pinjaman</a></li>
                </ul>
              </li>
              <li class="menu-header">Tampilan</li>
              <li class="nav-item dropdown {{ ($title == 'Thumbnail' || $title == 'Tambah Thumbnail' || $title == 'Edit Thumbnail' ) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-image"></i> <span>Thumbnail</span></a>
                <ul class="dropdown-menu">
                  <li {{ ($title == 'Thumbnail') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('thumbnail.index') }}">Thumbnail</a></li>
                  <li {{ ($title == 'Tambah Thumbnail') ? 'class=active' : '' }}><a class="nav-link link" href="{{ route('thumbnail.create') }}">Tambah Thumbnail</a></li>
                </ul>
              </li>
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="{{ route('index') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Lihat Web
              </a>
            </div>
        </aside>
      </div>
