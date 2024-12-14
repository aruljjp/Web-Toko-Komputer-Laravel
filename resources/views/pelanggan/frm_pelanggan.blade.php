@extends('layout.template')

@section("page_title","Pelanggan")
@section('content')
<style>
  thead{background-color: greenyellow;}
  tbody{background-color: white;}
  th{color: black;}
  td{color: black;}
  .input-group{margin: 10px}
  .pull-left{float: left;}
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
<form action="{{url('/pelanggan/frm_pelanggan/cari')}}" method="GET">
  <div class="search col-md-8">
    <div class="input-group">
        <input id="search" type="text" class="form-control" placeholder="search" name="search">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a type="button" class="btn btn-primary" href="{{ url('/pelanggan/create_pelanggan') }}" style="float: left;margin-left:10px">Add Pelanggan</a>
    </div>
  </div>
</form>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th class="hidden">Alamat</th>
        <th>Telp</th>
        {{-- <th>Jenis Kelamin</th> --}}
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pelanggan as $table)
      <tr>
        <td scope="row">{{$loop -> iteration}}</td>
        <td>{{$table->nama}}</td>
        <td class="hidden">{{$table->alamat}}</td>
        <td>{{$table->telp}}</td>
        {{-- <td>{{ $table->jkel == 1 ? "Laki-Laki" : "Perempuan" }}</td> --}}
        <td>
            <a href="{{ url('pelanggan/edit_pelanggan/'.$table->id.'') }}"><span class="badge bg-success"><i class="fas fa-pencil-alt"></i></span></a>
            <a href="{{ url('pelanggan/hapus/'.$table->id.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
        </td>
      </tr>
      @endforeach
    </tbody>
</table>
<div class="pull-left">
  {{$pelanggan->appends($_GET)->links() }}
</div>
@endsection