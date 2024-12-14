@extends('layout.template')

@section("page_title","New Kategori")
@section('content')
<form method="POST" action="{{ url('/kategori/frm_kategori') }}" enctype="multipart/form-data">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label>Kategori</label>
      <input type="text" class="form-control" id="kategori" name="kategori">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-danger">Reset</button>
  </div>
</form>
@endsection