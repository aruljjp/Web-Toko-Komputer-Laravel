@extends('layout.template')

@section("page_title","Edit User")
@section('content')
<form method="POST" action="{{ url('user/update/'.$user->id.'') }}" enctype="multipart/form-data">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label for="exampleInputName">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
    </div>
    <div class="form-group">
      <label for="exampleInputLevel">Jabatan</label><br>
      <select class="form-select" aria-label="Default select example" id="level" name="level">
        <option selected><--- Pilih Sebagai ---></option>
        <option {{ @$user->level == 'admin' ? "selected" : "" }} value="admin">admin</option>
        <option {{ @$user->level == 'pegawai' ? "selected" : "" }} value="pegawai">pegawai</option>
      </select>
    </div>
    <div class="form-group">
      <label>Foto</label>
      <input type="file" class="form-control" id="foto" name="foto" value="{{ $user->foto }}">
      <input type="hidden" name="oldfoto" value="{{ $user->oldfoto }}">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="reset" class="btn btn-danger">Reset</button>
</form>
@endsection