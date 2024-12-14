@extends('layout.template')

@section("page_title","Barang")
@section('bc', 'Barang')
@section('subbc', 'Barang')
@section('content')
<style>
  .card{margin-bottom: 0}
  .card-body{padding: 0} 
  .input-group{margin: 10px}
  .pull-left{float: left;}
  .pull-right{float: right;}
  .table thead{background-color: red}
  @media screen and (max-width: 900px)  {
	.hidden{
		display:none;
	}
  }
</style>
{{-- @if(session('pesan'))
<div class="alert alert-success" role="alert">
  {{session('pesan')}}
</div>
@elseif(session('error'))
<div class="alert alert-danger" role="alert">
  {{session('error')}}
</div>
@endif --}}
{{-- <form action="{{url('/barang/frm_barang/cari')}}" method="GET">
  <div class="search col-md-8">
    <div class="input-group">
      <input id="search" type="text" class="form-control" placeholder="search" name="search">
      <input id="cari" type="text" class="form-control" placeholder="cari" name="cari">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a type="button" class="btn btn-primary" href="{{ url('/barang/create_barang') }}" style="float: left;margin-left:10px">New Barang</a>
    </div>
  </div>
</form> --}}
<div class="pull-left">
  {{$barang->appends($_GET)->links() }}
</div>
<table class="table">
  <thead>
    <tr>
      <th width="1%">No</th>
      <th width="10%">Nama</th>
      {{-- <th class="hidden" width="1%">Kategori</th> --}}
      <th width="10%">harga</th>
      <th width="10%">Diskon</th>
      <th class="hidden" width="1%">Stok</th>
      <th class="hidden" width="10%">foto</th>
      {{-- <th width="10%">Action</th> --}}
    </tr>
  </thead>
  <tbody>
    @foreach($barang as $no => $table)
    <tr>
      <td>{{++$no + ($barang->firstItem()-1)}}</td>
      <td>{{$table->nama}}</td>
      {{-- <td class="hidden">{{$table->kategori}}</td> --}}
      <td>Rp.{{number_format($table->harga,0,',','.')}}</td>
      <td>{{$table->diskon}}%</td>
      <td class="hidden"><span class="badge bg-success">{{$table->stok}}</span></td>
      <td class="hidden"><img style="width: 100px" src="{{asset('/images/'.$table->foto)}}"></td>
      {{-- <td>
        <a href="{{ url('barang/edit_barang/'.$table->id.'') }}"><span class="badge bg-success"><i class="fas fa-pencil-alt"></i></span></a>
        <a href="{{ url('kategori/delete/'.$table->id.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
      </td> --}}
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