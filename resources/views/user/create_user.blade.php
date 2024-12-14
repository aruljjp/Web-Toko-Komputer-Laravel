@extends('layout.template')

@section("page_title","Add User")
@section('content')
<form method="POST" action="{{ url('/user/index') }}" enctype="multipart/form-data">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label for="exampleInputName">Name</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail">Email</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
      <label for="exampleInputLevel">Jabatan</label><br>
      <select class="form-select" aria-label="Default select example" id="level" name="level">
        <option selected><--- Pilih Sebagai ---></option>
        <option value="admin">admin</option>
        <option value="pegawai">pegawai</option>
      </select>
    </div>
    <div class="form-group">
      <label>Foto</label>
      <input type="file" class="form-control" id="foto" name="foto">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="reset" class="btn btn-danger">Reset</button>
</form>
@endsection