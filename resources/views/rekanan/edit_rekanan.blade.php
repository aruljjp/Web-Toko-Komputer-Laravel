@extends('layout.template')

@section("page_title","Edit Rekan")
@section('content')
<form method="POST" action="{{ url('rekanan/update/'.$rekanan->id.'') }}">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label>Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" value="{{ $rekanan->nama }}">
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $rekanan->alamat }}">
    </div>
    <div class="form-group">
      <label>No Telp</label>
      <input type="text" class="form-control" id="telp" name="telp" value="{{ $rekanan->telp }}">
    </div>
    {{-- <div class="form-group">
      <label for="jkel">Jenis Kelamin</label>
      <select class="custom-select rounded-0" id="jkel" name="jkel">
          <option {{ @$rekanan->jkel == 1 ? "selected" : "" }} value="1">Laki-Laki</option>
          <option {{ @$rekanan->jkel == 2 ? "selected" : "" }} value="2">Perempuan</option>
      </select>
    </div> --}}
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection