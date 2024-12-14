@extends('layout.template2')
@section('content')
<style>
  .pull-left{margin-top:10px;float: left;}
  .pull-right{float:right;margin-top:10px}
</style>
<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-bottom:10px">
      <h2 class="text-center">Home</h2>
      @if(session('pesan'))
      <div class="alert alert-success" role="alert">
        {{session('pesan')}}
      </div>
      @endif
      <form style="width:100%" action="{{url('/home2/cari')}}" method="GET">
        <div class="search col-md-12">
          <div class="input-group">
            <input type="text" id="search" class="form-control" placeholder="nama" name="search">
            <input type="text" id="cari" class="form-control" placeholder="kategori" name="cari">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      <div class="pull-left">
        {{$barang->appends($_GET)->links() }}
      </div>
    </div>
  </div>
  <div class="row">

    <!-- produk pertama -->
    @foreach($barang as $a)
    <div class="col-md-3">
      <div class="card shadow-sm" style="margin-bottom: 10px">
        <div class="card-header">
          <a href="{{ url('/detail_barang/'.$a->id.'') }}"><img src="{{asset('/images/'.$a->foto)}}" class="card-img-top"></a>
        </div>
        <div class="card-body">
          <p class="card-text">
            {{$a->nama}}
          </p>
          <p class="card-text">Harga: Rp.{{number_format($a->harga,0,',','.')}}</p>
        </div>
        <div class="card-body">
          <a href="{{ url('/order/frm_order/'.$a->id.'') }}"><button type="button" class="btn btn-success">Pesan</button></a>
        </div>
      </div>
    </div>
    @endforeach
  </div>


  <!-- tentang toko -->
  <hr>
  <div class="row mt-4">
    <div class="col">
      <h5 class="text-center">Diskripsi Toko</h5>
      <p>
        Aplikai Toko Kami adalah Aplikasi toko yang menyediakan alat dan peralatan elektronik. Di dalam aplikasi ini terdapat admin yang bisa menginput data barang,pelanggan,rekanan dan melihat laporan,kasir yang bisa menerima order dan melakukan transaksi penjualan dan pembelian.
      </p>
      {{-- <p>
        Toko adalah demo membangun toko online menggunakan laravel framework. Di dalam demo ini terdapat user bisa menginput data kategori, produk dan transaksi.
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic laborum aliquam dolorum sequi nulla maiores quos incidunt veritatis numquam suscipit. Cumque dolore rem obcaecati. Eos quod ad non veritatis assumenda.
      </p> --}}
      <p class="text-center">
        <a href="" class="btn btn-outline-secondary">
          Baca Selengkapnya
        </a>      
      </p>
    </div>
  </div>
  <!-- end tentang toko -->
</div>
@endsection