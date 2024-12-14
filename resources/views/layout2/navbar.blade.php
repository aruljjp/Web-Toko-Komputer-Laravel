<nav class="navbar navbar-expand-lg navbar-light bg-warning">
  <div class="container-fluid">
    {{-- <img src="{{ asset('uploads/logo.png')}}" alt="" style="height: 50px"> --}}
    <a class="navbar-brand" href="#" style="color: red">jayacom</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      {{-- <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Kategori
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{url('/kategori/handphone')}}">Smartphone</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div> --}}
      @if(Auth::guest())
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
      </ul>
      {{-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/about')}}">About</a>
        </li>
      </ul> --}}
      <form class="form-inline ml-0 ml-md-3" role="search" action="{{url('/homepage/search')}}" method="GET">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-search" type="text" placeholder="Search" aria-label="Search" name="search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <ul class="mr-auto navbar-nav"></ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{url('auth/login')}}">Login</a>
        </li>
      </ul>
      {{-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link disabled" href="{{url('order/data_pesanan')}}">Detail Pesanan</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link disabled" href="{{url('wishlist')}}">Wishlist</a>
        </li>
      </ul> --}}
      @else
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
      </ul>
      {{-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/about')}}">About</a>
        </li>
      </ul> --}}
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{url('order/data_pesanan')}}">Detail Pesanan</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{url('wishlist')}}">Wishlist</a>
        </li>
      </ul>
      <form class="form-inline ml-0 ml-md-3" role="search" action="{{url('/homepage/search')}}" method="GET">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-search" type="text" placeholder="Search" aria-label="Search" name="search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <ul class="mr-auto navbar-nav"></ul>
      <ul class="navbar-nav">
        {{-- <li class="nav-item active">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/produk">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/kategori">Kategori</a>
        </li> --}}
        {{-- <div class="container-fluid">
          <form class="d-flex" action="{{url('/homepage/search')}}" method="GET">
            <input class="form-control me-2" type="text" placeholder="" aria-label="Search" name="search">
            <button class="btn btn-outline-dark" type="submit">Search</button>
          </form>
        </div> --}}
        @php
          $total = DB::table('tb_tampung-detail')->sum('total');
          $item = DB::table('tb_tampung-detail')->count();
        @endphp
        <li class="nav-item">
          <a class="btn btn-secondary" href="{{url('/order/frm_order')}}" role="button"><i class="fa fa-shopping-cart"></i> {{$item}} Item | Rp.{{number_format($total,0,',','.')}}</a>
          {{-- <a class="nav-link" href="{{url('/order/frm_order')}}"><i class="fa fa-shopping-cart"></i>            
          </a> --}}
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{url('/order/data_pesanan')}}">Pesanan</a>
        </li> --}}
        {{-- <li class="nav-item">
          <a class="nav-link" href="#">Kontak</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tentang Kami</a>
        </li> --}}
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="{{asset('/uploads/'.Auth::user()->foto)}}" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-warning">
              <img src="{{asset('/uploads/'.Auth::user()->foto)}}" class="img-circle elevation-2" alt="User Image">
              <p>
                {{ Auth::user()->name }} - {{ Auth::user()->level }}
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="{{url('/profile')}}" class="btn btn-default btn-flat">Profile</a>
              <a href="{{url('/logout')}}" class="btn btn-default btn-flat float-right">Logout</a>
            </li>
          </ul>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{url('/logout')}}">Logout</a>
        </li> --}}
        {{-- <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{Auth::user()->email}}</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="{{url('/logout')}}" class="dropdown-item"><i class="nav-icon fas fa-sign-out-alt"></i> Logout</a></li>
          </ul>
        </li> --}}
      </ul>
      @endif
    </div>
  </div>
</nav>