@extends('layout2.template')
@section('content')
<style>
  .card{width: 18%;float:left;margin-right:1px;margin-top:100px}
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
    .row{margin:1px}
    .card{width: 100%}
    .card-body{width: 100%;margin:1px}
    .search{margin-top:1px;}
  }
</style>
<div class="container">
  <div class="card">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link disabled">Kategori</a>
      </li>
      <li class="nav-item">
        <a style="color: rgb(55, 131, 230)" class="nav-link" href="{{url('/kategori/handphone')}}">Smartphone</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="row" style="margin: 1px">
      <div class="col-md-12">
          <h1 class="mb-4" style="color:black">Smartphone</h1>
      </div>
      @foreach($barang as $dt)
      <div class="col-6 col-md-3">
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
      <div class="pull-left">
        {{$barang->appends($_GET)->links()}}
      </div>
    </div>
  </div>
</div>
@endsection