@extends('layout.template')

@section("page_title","Change Password")
@section('content')
@if(session('pesan'))
<div class="alert alert-success" role="alert">
  {{session('pesan')}}
</div>
@endif
<form method="POST" action="{{ url('user/password') }}">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label>Password Baru</label>
      <input type="text" class="form-control" id="newpassword" name="newpassword" required>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="reset" class="btn btn-danger">Reset</button>
</form>
@endsection