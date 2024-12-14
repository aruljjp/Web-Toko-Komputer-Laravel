<style>
  h5{margin-bottom: 1px;color: black}
  .sidebar{padding-left: 1px;padding-right: 1px;}
  p{color: black;margin: 0}
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color:rgb(192, 192, 192);height:1000px;border-right-color: black">
  <a class="brand-link" style="border-bottom-color: black">
    {{-- <img src="{{ asset('uploads/logo.png')}}" alt="" style="width: 100%"> --}}
    <span class="brand-text font-weight-light" style="color: red;"><h1>jayacom</h1></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-color: black">
      <div class="image">
        <img src="{{asset('/uploads/'.Auth::user()->foto)}}" class="img-circle elevation-2" style="width: 50px;height:50px;float: left;  margin-left: auto;order: 2;">
      </div>
      <div class="info">
        <p>{{ Auth::user()->name }}</p>
        @if(Auth::user()->level=="admin")
          <span class="text-primary">Admin</span>
        @else
          <span class="text-success">Pegawai</span>
        @endif
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(Auth::user()->level=='admin')
        <li class="{{request()->is('dashboard') ? 'nav-item active' : ''}}">
          <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-sliders-h"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="{{request()->is('home') ? 'nav-item active' : ''}}">
          <a href="{{ url('/home') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <li class="nav-header"><h5>Data Master</h5></li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/user/frm_user') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data User</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ url('/user/create_user') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add User</p>
              </a>
            </li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Barang
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/barang/frm_barang') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Barang</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Kategori
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/kategori/data_kategori') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Kategori</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-circle"></i>
            <p>
              Rekanan
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/rekanan/frm_rekanan') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Rekanan</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-house-user"></i>
            <p>
              Pelanggan
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/pelanggan/frm_pelanggan') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Pelanggan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header"><h5>Transaksi</h5></li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Transaksi
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/penjualan/frm_penjualan') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Penjualan</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/pembelian/frm_pembelian') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembelian</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header"><h5>Report</h5></li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              Order
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/order/data_order') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Order</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
              Laporan
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/penjualan/laporan') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Penjualan</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/pembelian/laporan') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembelian</p>
              </a>
            </li>
          </ul>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ url('/home') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Kategori
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/kategori/data_kategori') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Kategori</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header"><h5>Transaksi</h5></li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Transaksi
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/penjualan/frm_penjualan') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Penjualan</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/pembelian/frm_pembelian') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembelian</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header"><h5>Report</h5></li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              Order
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/order/data_order') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Order</p>
              </a>
            </li>
          </ul>
        </li> --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
              Laporan
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/penjualan/laporan') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Penjualan</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/pembelian/laporan') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembelian</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
      </ul>
    </nav>
  </div>
</aside>