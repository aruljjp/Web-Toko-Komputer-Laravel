<header class="topbar" data-navbarbg="skin6">
  <nav class="main-header navbar navbar-expand navbar-light navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          @if(session('pesan'))
          <a class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i>{{session('pesan')}}
            {{-- <span class="float-right text-muted text-sm">3 mins</span> --}}
          </a>
          @endif
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/user/password') }}"><i class="nav-icon fas fa-lock"></i></a>
      </li>
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{asset('/uploads/'.Auth::user()->foto)}}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="{{asset('/uploads/'.Auth::user()->foto)}}" class="img-circle elevation-2" alt="User Image">
            <p>
              {{ Auth::user()->name }} - {{ Auth::user()->level }}
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{url('/profile-user/profile')}}" class="btn btn-default btn-flat">Profile</a>
            <a href="{{url('/logout')}}" class="btn btn-default btn-flat float-right">Sign out</a>
          </li>
        </ul>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('/logout')}}">Logout</a>
      </li> --}}
      {{-- <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{Auth::user()->email}}</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
          <li><a href="{{ url('/user/password') }}" class="dropdown-item"><i class="nav-icon fas fa-lock"></i>  Password</a></li>
          <li><a href="{{url('/logout')}}" class="dropdown-item"><i class="nav-icon fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </li> --}}
    </ul>
    {{-- <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
      <img src="{{asset('/uploads/'.Auth::user()->foto)}}" alt="user" class="img-circle elevation-2" style="width: 40px;height:40px;float: right;  margin-left: auto;order: 2;">
    </div> --}}
  </nav>
</header>
