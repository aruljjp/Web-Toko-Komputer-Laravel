@extends('layout.template')

@section("page_title","Add Pelanggan")
@section('content')
<form method="POST" action="{{ url('/pelanggan/frm_pelanggan') }}">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label>Nama</label>
      <input type="text" class="form-control" id="nama" name="nama">
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <input type="text" class="form-control" id="alamat" name="alamat">
    </div>
    <div class="form-group">
      <label>No Telp</label>
      <input type="text" class="form-control" id="telp" name="telp">
    </div>
    {{-- <div class="form-group">
      <label for="jkel">Jenis Kelamin</label>
      <select class="custom-select rounded-0" id="jkel" name="jkel">
          <option value="1">Laki-Laki</option>
          <option value="2">Perempuan</option>
      </select>
    </div> --}}
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-danger">Reset</button>
  </div>
</form>
@endsection