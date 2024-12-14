@extends('layout.template')

@section("page_title","Rekan")
@section('content')
<style>
  thead{background-color: rgb(38, 212, 235);}
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
<form action="{{url('/rekanan/frm_rekanan/cari')}}" method="GET">
  <div class="search col-md-8">
    <div class="input-group">
      <input id="search" type="text" class="form-control" placeholder="search" name="search">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a type="button" class="btn btn-primary" href="{{ url('/rekanan/create_rekanan') }}" style="float: left;margin-left:10px">Add Rekanan</a>
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
      @foreach($rekanan as $table)
      <tr style="text-align: left;">
        <td scope="row">{{$loop -> iteration}}</td>
        <td>{{$table->nama}}</td>
        <td class="hidden">{{$table->alamat}}</td>
        <td>{{$table->telp}}</td>
        {{-- <td>{{ $table->jkel == 1 ? "Laki-Laki" : "Perempuan" }}</td> --}}
        <td>
            <a href="{{ url('rekanan/edit_rekanan/'.$table->id.'') }}"><span class="badge bg-success"><i class="fas fa-pencil-alt"></i></span></a>
            <a href="{{ url('rekanan/hapus/'.$table->id.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
        </td>
      </tr>
      @endforeach
    </tbody>
</table>
<div class="pull-left">
  {{$rekanan->appends($_GET)->links() }}
</div>
@endsection