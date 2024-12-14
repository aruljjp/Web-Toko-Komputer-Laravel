@extends('layout2.template')
@section('content')
<style>
  .error-page{margin-top: 200px}
</style>
<div class="error-page">
    <h2 class="headline text-danger"> 404</h2>

    <div class="error-content">
      <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Halaman tidak ditemukan.</h3>

      <p>
        Silahkan login terlebih dahulu ke<br/><a href="{{url('auth/login')}}">halaman login</a> untuk membuka website.
      </p>
    </div>
    <!-- /.error-content -->
</div>
@endsection