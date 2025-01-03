<header class="main-header">

  <!-- Logo -->
  <a href="{{ route('dashboard') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>T</b>ut</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>T</b>utorials <b>A</b>pp</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
            @php($user = \Auth::user())
            <span class="hidden-xs">{{ $user->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

              <p>
                {{ $user->name }}
                <small>Member since {{ $user->created_at->format('M d, Y') }}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div>
                <a href="javascript:void(0);" onclick="$('#logout').submit();" class="btn btn-default btn-flat" style="width: 100%;">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <form action="{{ route('logout') }}" id="logout" method="POST">
    @csrf
  </form>
</header>