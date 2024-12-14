@extends('layout2.template')
@section('content')
<style>
  .card{width: 18%;float:left;margin-right:1px;margin-top:90px}
  .card-body{width: 80%;float:right;margin-top:1px}
  .pull-left{margin-top:1px;float: left;}
  .pull-right{float:right;margin-top:10px}
  .input{width:500px}
  .category-card{
    border: 1px solid #ddd;
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
    margin-bottom: 24px;
    background-color: #fff;
  }
  .category-card a{
      text-decoration: none;
  }
  .category-card .category-card-img{
    max-height: 260px;
    overflow: hidden;
    border-bottom: 1px solid #ccc;
  }
  .category-card .category-card-body{
      padding: 10px 16px;
  }
  .category-card .category-card-body h5{
      margin-bottom: 0px;
      font-size: 18px;
      font-weight: 600;
      color: #000;
      text-align: center;
  }
  .category-card .category-card-body p{
    margin-top: 10px;
    margin-bottom: 0px;
    font-size: 18px;
    color: #000;
    text-align: left;
  }
  @media screen and (max-width: 900px)  {
    .card{width: 100%}
    .card-body{width: 100%;}
    .search{margin-top:1px;}
  }
</style>
<div class="container">
  <!-- carousel -->
  <div class="row" style="margin-top:10px">
    <div class="col">
      <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('uploads/apple.jpg')}}" class="d-block w-100">
          </div>
          <div class="carousel-item active">
            <img src="{{ asset('uploads/oppo.jpg')}}" class="d-block w-100">
          </div>
          <div class="carousel-item active">
            <img src="{{ asset('uploads/vivo.png')}}" class="d-block w-100">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
  <br>
  <br>
  <!-- end carousel -->
  @if(session('pesan'))
  <div class="alert alert-success" role="alert">
    {{session('pesan')}}
  </div>
  @elseif(session('danger'))
  <div class="alert alert-danger" role="alert">
    {{session('danger')}}
  </div>
  @endif
  {{-- <form action="{{url('/homepage/cari')}}" method="GET">
    <div class="search col-md-12" style="margin-top:10px">
      <div class="input-group">
        <input id="search" type="text" class="form-control" placeholder="search produk..." name="search" value="{{old('search')}}">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/homepage"><button type="back" class="btn btn-danger">Back</button></a>
      </div>
    </div>
  </form> --}}
  <div class="card">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link disabled">Kategori</a>
      </li>
      <li class="nav-item">
        <a style="color: rgb(55, 131, 230)" class="nav-link" href="{{url('/kategori2/handphone')}}">Smartphone</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Laptop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Sparepart Komputer</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="row" style="margin: 1px">
      <h1 style="color:black">{{$title}}</h1>
      @foreach($barang as $dt)
      <div class="col-6 col-md-4">
        <div class="category-card">
          {{-- <a href="{{ url('/detail_barang/'.$dt->id.'') }}"> --}}
          <div class="category-card-img">
              <img src="{{asset('/images/'.$dt->foto)}}" class="w-100">
          </div>
          <div class="category-card-body">
            <h5>{{$dt->nama}}</h5>
            <p>Harga: RP.{{number_format($dt->harga,0,',','.')}}</p>
            <div class="btn-group" role="group" aria-label="Basic example" style="margin-top:10px">
              <a class="btn btn-success" href="{{ url('/detail_barang/'.$dt->id.'') }}" role="button" >Detail</a>
              @if (Auth::guest())
                @php
                $love = DB::table('tb_wishlist')->where('id_barang',$dt->id)->get();
                @endphp
                @if ($love->isEmpty())
                <a href="{{ url('/homepage/'.$dt->id.'') }}" type="button" class="btn btn-link"><i class="fa-regular fa-heart" style="color: red;display:none"></i></a>
                @else
                <a href="{{ url('/homepage/'.$dt->id.'') }}" type="button" class="btn btn-link"><i class="fa-solid fa-heart" style="color: red;display:none"></i></a>
                @endif
              @else
                @php
                  $love = DB::table('tb_wishlist')->where('id_barang',$dt->id)->get();
                @endphp
                @if ($love->isEmpty())
                <a href="{{ url('/homepage/'.$dt->id.'') }}" type="button" class="btn btn-link"><i class="fa-regular fa-heart" style="color: red"></i></a>
                @else
                <a href="{{ url('/homepage/'.$dt->id.'') }}" type="button" class="btn btn-link"><i class="fa-solid fa-heart" style="color: red"></i></a>
                @endif
              @endif
            </div>
          </div>
          {{-- </a> --}}
        </div>
      </div>
      @endforeach
    </div>
    <div class="pull-left">
      {{$barang->appends($_GET)->links() }}
    </div>
  </div>
  {{-- <div class="row">

    <!-- produk pertama -->
    @foreach($barang as $a)
    <div class="col-md-3">
      <div class="card shadow-sm" style="margin-bottom: 10px">
        <div class="card-header">
          <a href="{{ url('/detail_barang/'.$a->id.'') }}"><img src="{{asset('/images/'.$a->foto)}}" class="card-img-top"></a>
        </div>
        <div class="card-body">
          <p class="card-text">
            {{$a->nama}}
          </p>
          <p class="card-text">Harga: Rp.{{number_format($a->harga,0,',','.')}}</p>
        </div>
        <div class="card-body">
          <a href="{{ url('/order/frm_order/'.$a->id.'') }}"><button type="button" class="btn btn-success">Pesan</button></a>
        </div>
      </div>
    </div>
    @endforeach --}}
  {{-- </div> --}}


  <!-- tentang toko -->
  {{-- <br>
  <br>
  <hr> --}}
  {{-- <div class="row mt-4">
    <div class="col">
      <h5 class="text-center">ABOUT US</h5>
      <p>
        Aplikai Toko Kami adalah Aplikasi toko yang menyediakan berbagai macam peralatan elektronik dan lain-lain.
      </p>
      <p class="text-center">
        <a href="" class="btn btn-outline-secondary">
          Baca Selengkapnya
        </a>      
      </p>
    </div>
    <div class="col">
      <h5 class="text-left">Our Address</h5>
      <p>
        Jl. Serayu Timur 155 Taman Kota Madiun Jawa timur,Indonesia,Telp:(+62)351 452329,Email: info@ageecomputer.com
      </p>
      <h5 class="text-left">Opening Hours</h5>
      <p>Monday to Sunday: 08:00 AM - 05:00 PM</p>
      <p></p>
      <p class="text-center">
        <a href="" class="btn btn-outline-secondary">
          Baca Selengkapnya
        </a>      
      </p>
    </div>
  </div>
  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2796.125335422395!2d111.5309636801149!3d-7.648873471064312!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7100245b78d9d94a!2sAgee+Computer!5e0!3m2!1sen!2sid!4v1552866781718" width="1100" height="400" frameborder="0" style="border:0"></iframe> --}}
</div>
@endsection