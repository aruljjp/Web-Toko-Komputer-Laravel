@extends('layout.template')

@section("page_title","New Barang")
@section('content')
<form method="POST" action="{{ url('/barang/frm_barang') }}" enctype="multipart/form-data">
  @csrf
  <div class="card-body">
    <div class="form-group">
      <label>Nama Barang</label>
      <input type="text" class="form-control" id="nama" name="nama">
    </div>
    <div class="form-group">
      <label>Kategori</label>
      <select name="id_kategori" id="id_kategori" class="form-control id_kategori" aria-label="Default select example">
        <option selected><-- Pilih Kategori --></option>
        @foreach($kategori as $kt)
          <option value="{{ $kt->id }}">{{ $kt->kategori }}</option>
        @endforeach
      </select>
      {{-- <input type="text" class="form-control" id="kategori" name="kategori"> --}}
    </div>
    <div class="form-group">
      <label>Harga</label>
      <div class="input-group mb-3">
        <span class="input-group-text">Rp</span>
        <input type="number" class="form-control" id="harga" name="harga">
      </div>
    </div>
    <div class="form-group">
      <label>Diskon</label>
      <input type="number" class="form-control" id="diskon" name="diskon">
    </div>
    <div class="form-group">
      <label>Stok</label>
      <input type="number" class="form-control" id="stok" name="stok">
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea type="text" class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
      <label>Foto</label>
      <input type="file" class="form-control" id="foto" name="foto">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-danger">Reset</button>
  </div>
</form>
@endsection