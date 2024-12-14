@extends('layout.template')

@section("page_title","Kategori")
@section('content')
<style>
  .card{margin-bottom: 0}
  .card-body{padding: 0}  
  .input-group{margin: 10px}
  .pull-left{float: left;}
  .pull-right{float: right;}
  .table thead{background-color:yellow}
  @media screen and (max-width: 900px)  {
	.hidden{
		display:none;
	}
  }
</style>
@if(session('pesan'))
<div class="alert alert-success" role="alert">
  {{session('pesan')}}
</div>
@elseif(session('error'))
<div class="alert alert-danger" role="alert">
  {{session('error')}}
</div>
@endif
{{-- <form action="{{url('/barang/frm_kategori/cari')}}" method="GET">
  <div class="search col-md-8">
    <div class="input-group">
      <input id="search" type="text" class="form-control" placeholder="search" name="search">
      <input id="cari" type="text" class="form-control" placeholder="cari" name="cari">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a type="button" class="btn btn-primary" href="{{ url('/barang/create_barang') }}" style="float: left;margin-left:10px">New Barang</a>
    </div>
  </div>
</form> --}}
<a type="button" class="btn btn-primary" href="{{ url('/kategori/create_kategori') }}" style="float: left;margin-bottom:10px">New Kategori</a>
<div class="pull-left">
  {{$kategori->appends($_GET)->links() }}
</div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="1%">No</th>
      <th width="10%">Kategori</th>
      <th width="10%">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($kategori as $no => $table)
    <tr>
      <td>{{++$no + ($kategori->firstItem()-1)}}</td>
      <td>
        <a href="{{url('kategori/data_barang/'.$table->id.'')}}">{{$table->kategori}}</a>
      </td>
      <td>
        <a href="{{ url('kategori/hapus/'.$table->id.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{-- <div class="pull-right">
Menampilkan
{{$barang->firstItem()}}
sampai
{{$barang->lastItem()}}
dari
{{$barang->total()}}
</div> --}}
@endsection