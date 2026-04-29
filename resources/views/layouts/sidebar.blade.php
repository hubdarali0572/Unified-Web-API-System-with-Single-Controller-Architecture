<nav class="sidebar">


  <div class="sidebar-header" style="background-color: #87cefa;">
    <a href="#" class="sidebar-brand" style="padding-left:50px;">
      <img src="{{ asset('assets/images/others/logo_instivio.jpeg') }}"
        class="wd-50 ht-50 rounded-circle"
        alt="logo">
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div class="sidebar-body" style="background: #042954;">
    <ul class="nav">
      <li class="nav-item {{ active_class(['dashboard.index']) }}">
        <a href="{{ route('dashboard.index') }}" class="nav-link">
          <i class="link-icon fas fa-th-large" style="color: #87cefa;"></i>
          <span class="link-title" style="color: #fff;">Dashboard</span>
        </a>
      </li>

      <li class="nav-item {{ active_class(['users.index', 'users.create','users.edit']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-controls="feetype">
          <i class="link-icon fas fa-user-graduate" style="color: #87cefa;"></i>
          <span class="link-title" style="color: #fff;"> User Management</span>
          <i class="link-arrow" data-feather="chevron-down" style="color: #fff;"></i>
        </a>
        <div id="users" class="collapse {{ show_class(['users.index', 'users.create','users.edit']) }}">
          <ul class="nav sub-menu">

            <li class="nav-item">
              <a href="{{ route('users.index') }}" class="nav-link {{ active_class([ 'users.index']) }}" style="color: #fff;">
                <i class="fas fa-users me-2" style="color: #87cefa;"></i> list of User
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('users.create') }}" class="nav-link {{ active_class([ 'users.create']) }}" style="color: #fff;">
                <i class="fa-solid fa-user-plus me-2" style="color: #87cefa;"></i> Add New User
              </a>
            </li>
          </ul>
        </div>
      </li>


      <li class="nav-item {{ active_class(['students.index', 'students.create','students.edit']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#student" role="button" aria-controls="feetype">
          <i class="link-icon fas fa-user-graduate" style="color: #87cefa;"></i>
          <span class="link-title" style="color: #fff;"> Student Management</span>
          <i class="link-arrow" data-feather="chevron-down" style="color: #fff;"></i>
        </a>
        <div id="student" class="collapse {{ show_class(['students.index', 'students.create','students.edit']) }}">
          <ul class="nav sub-menu">

            <li class="nav-item">
              <a href="{{ route('students.index') }}" class="nav-link {{ active_class([ 'students.index']) }}" style="color: #fff;">
                <i class="fas fa-users me-2" style="color: #87cefa;"></i> list of Student
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('students.create') }}" class="nav-link {{ active_class([ 'students.create']) }}" style="color: #fff;">
                <i class="fa-solid fa-user-plus me-2" style="color: #87cefa;"></i> Add New Student
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ active_class(['class.index', 'class.create','class.edit']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#class" role="button" aria-controls="feetype">
          <i class="link-icon fas fa-user-graduate" style="color: #87cefa;"></i>
          <span class="link-title" style="color: #fff;"> Class Management</span>
          <i class="link-arrow" data-feather="chevron-down" style="color: #fff;"></i>
        </a>
        <div id="class" class="collapse {{ show_class(['class.index', 'class.create','students.class']) }}">
          <ul class="nav sub-menu">

            <li class="nav-item">
              <a href="{{ route('class.index') }}" class="nav-link {{ active_class([ 'class.index']) }}" style="color: #fff;">
                <i class="fas fa-users me-2" style="color: #87cefa;"></i> list of Class
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('class.create') }}" class="nav-link {{ active_class([ 'class.create']) }}" style="color: #fff;">
                <i class="fa-solid fa-user-plus me-2" style="color: #87cefa;"></i> Add New Class
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Logout -->
      <li class="nav-item {{ active_class(['pulse']) }}">
        <a href="{{ url('pulse') }}" class="nav-link">
          <i class="link-icon fa-solid fa-arrow-right-from-bracket" style="color: #87cefa;"></i>
          <span class="link-title" style="color: #fff;">Pulse</span>
        </a>
      </li>

      <!-- Logout -->
      <li class="nav-item {{ active_class(['logout', 'logout/*']) }}">
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="link-icon fa-solid fa-arrow-right-from-bracket" style="color: #87cefa;"></i>
          <span class="link-title" style="color: #fff;">Logout</span>
        </a>
      </li>

    </ul>
  </div>
</nav>