<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>

  <div class="navbar-content">

    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <!-- Notification icon/button -->
        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i data-feather="bell"></i>
          <div class="indicator">
            <div class="circle"></div>
          </div>
        </a>
        <!-- Notification Dropdown Menu -->
        <ul class="dropdown-menu dropdown-menu-end p-0 overflow-auto" aria-labelledby="notificationDropdown" style="max-height: 300px; width: 300px;">
          <li class="px-3 py-2 border-bottom">
            <p class="mb-0">{{ auth()->user()->notifications->count() }} Total Notifications</p>
          </li>
          @foreach(auth()->user()->notifications as $notification)

          <li class="p-1">
            <a href="{{ route('leaves.index') }}" class="dropdown-item d-flex align-items-center py-2">
              <div class="d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white p-1" style="width:30px;height:30px;" data-feather="gift"></i>
              </div>
              <ul class="list-unstyled">
                <li>
                  <div class="flex-grow-1 me-2">
                    <p class="text-muted mb-0">{!! html_entity_decode($notification->data['message'] ?? 'No message available') !!}</p>
                  </div>

                </li>
                <li>
                  <div class="flex-grow-1 me-2">
                    <p class="text-muted mb-0">{{ $notification->created_at->diffForHumans() }}</p>
                  </div>
                </li>
              </ul>
            </a>
          </li>
          @endforeach

          <li class="px-3 py-2 border-top text-center">
            <a href="javascript:;" class="text-muted">View all</a>
          </li>
        </ul>

      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="wd-35 ht-35 rounded-circle shadow" src="{{ asset('assets/images/others/download.png') }}" alt="Profile"> </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
              <img class="wd-50 ht-50 rounded-circle shadow" src="{{ asset('assets/images/others/download.png') }}" alt="Profile">
            </div>
            <div class="text-center">
              <p class="tx-16 fw-bolder" style="color:#042954;"> {{ Auth::user()->name }}</p>
              <p class="tx-12" style="color:#00A54F;"> {{ Auth::user()->email }}</p>
            </div>
          </div>
          <div class="text-center p-1">
            <div class=" p-1" style="background-color:#87cefa;border-radius: 3px;">
              <a href="{{ route('profile.edit') }}">
                <i class="fas fa-user-circle" style="font-size: 17px; color: #4A4A4A;"></i> <span style="color:#042954; font-size: 15px;">
                  Profile
                </span>
              </a>
            </div>

          </div>
          <ul class="list-unstyled p-1">
            <li class="dropdown-item d-flex justify-content-center align-items-center" style="background-color:#87cefa;">
              <a href="{{ route('logout') }}" class="text-body ms-0 d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                <span style="color:#042954; font-size: 15px;"><i class="fas fa-sign-out-alt" style="color:#042954"></i> Logout</span>

              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>