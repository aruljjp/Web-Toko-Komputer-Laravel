@extends('layout.template')

@section("page_title","Edit Pelanggan")
@section('content')
<form method="POST" action="{{ url('pelanggan/update/'.$pelanggan->id.'') }}">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label>Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" value="{{ $pelanggan->nama }}">
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pelanggan->alamat }}">
    </div>
    <div class="form-group">
      <label>No Telp</label>
      <input type="text" class="form-control" id="telp" name="telp" value="{{ $pelanggan->telp }}">
    </div>
    {{-- <div class="form-group">
      <label for="jkel">Jenis Kelamin</label>
      <select class="custom-select rounded-0" id="jkel" name="jkel">
          <option {{ @$pelanggan->jkel == 1 ? "selected" : "" }} value="1">Laki-Laki</option>
          <option {{ @$pelanggan->jkel == 2 ? "selected" : "" }} value="2">Perempuan</option>
      </select>
    </div> --}}
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-danger">Reset</button>
  </div>
</form>
@endsection