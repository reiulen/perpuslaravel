      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-md main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg text-primary"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell text-dark"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
              </div>
                <div class="dropdown-list-content dropdown-list-icons">
                 @if(Auth()->user()->role == 'Admin')
                    @foreach(App\Models\Aktifitasadmin::latest()->limit(10)->get() as $row)
                      <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-icon {{ $row->backgroud }} text-white">
                          <i class="{{ $row->icon }}"></i>
                        </div>
                        <div class="dropdown-item-desc">
                          {{ $row->notifikasi }}
                          <div class="time text-primary">{{ $row->created_at->diffforhumans() }}</div>
                        </div>
                      </a>
                    @endforeach
                    @else
                     @foreach(App\Models\Aktifitasadmin::where('user_id', Auth()->user()->id)->latest()->limit(10)->get() as $row)
                      <a href="#" class="dropdown-item dropdown-item-unread">
                          <div class="dropdown-item-icon {{ $row->backgroud }} text-white">
                            <i class="{{ $row->icon }}"></i>
                          </div>
                          <div class="dropdown-item-desc">
                            {{ $row->notifikasi }}
                            <div class="time text-primary">{{ $row->created_at->diffforhumans() }}</div>
                          </div>
                        </a>
                      @endforeach
                 @endif
                 @if(App\Models\Aktifitasadmin::where('user_id', Auth()->user()->id)->count()== 0 or App\Models\Aktifitasadmin::count() == 0)
                   <p class="text-center text-muted my-5">Belum ada notifikasi</p>
                 @endif
                </div>
              <div class="dropdown-footer text-center">
                <a href="#" class="link">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block text-dark">Hi, {{ auth()->user()->nama }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Login {{ $user->updated_at->diffForHumans() }}</div>
              <a href="features-profile.html" class="dropdown-item has-icon link">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon link">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon link">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger link">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>