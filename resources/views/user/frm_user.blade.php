@extends('layout.template')
@section("page_title","User")

@section('content')
<style>
  th{color: black;}
  tbody{background-color: white;}
  td{color: black;}
  .pull-left{float: left;}
  @media screen and (max-width: 900px)  {
    .hidden{
        display:none;
    }
  }
</style>
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{session('success')}}
</div>
@elseif(session('delete'))
<div class="alert alert-danger" role="alert">
  {{session('delete')}}
</div>
@endif
<a class="btn btn-primary" href="{{ url('/user/create_user') }}" role="button">Add User</a>
<div class="table-responsive">
  <table class="table table-bordered" style="margin-top:5px">
    <thead>
      <tr class="table-primary">
        <th>No</th>
        <th>Nama</th>
        <th class="hidden">Email</th>
        <th>Level</th>
        <th>Status</th>
        <th>Terakhir Aktif</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($user as $table)
      <tr>
        <td scope="row">{{$loop -> iteration}}</td>
        <td>{{$table->name}}</td>
        <td class="hidden">{{$table->email}}</td>
        <td>
          @if($table->level=="admin")
            <button type="button" class="btn btn-info">Admin</button>
          @elseif($table->level=="pegawai")
            <button type="button" class="btn btn-success">Pegawai</button>
          @else
            <span class="badge text-bg-secondary">Pelanggan</span>
          @endif
        </td>
        <td>
          @if(Cache::has('user-is-online-'.$table->id))
            <span class="text-success">Online</span>
          @else
            <span class="text-secondary">Offline</span>
          @endif
        </td>
        <td>{{ \Carbon\Carbon::parse($table->last_seen)->diffForHumans() }}</td>
        <td>
          <a href="{{ url('user/edit_user/'.$table->id.'') }}"><span class="badge bg-success"><i class="fas fa-pencil-alt"></i></span></a>
          <a href="{{ url('user/hapus/'.$table->id.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="pull-left">
  {{$user->appends($_GET)->links() }}
</div>
@endsection