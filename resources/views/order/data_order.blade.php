@extends('layout.template')
@section("page_title","Order")
@section('content')
<style>
  thead{background-color:deepskyblue}
  th{color:black;}
  tbody{background-color: white;}
  td{color: black;}
  @media screen and (max-width: 900px)  {
    .hidden{
      display:none;
    }
  }
</style>
@if(session('pesan'))
<div class="alert alert-success" role="alert">
  {{session('pesan')}}
</div>
@elseif(session('delete'))
<div class="alert alert-danger" role="alert">
  {{session('delete')}}
</div>
@endif
<div class="table-responsive">
<table class="table-bordered" border="1">
  <thead>
    <tr>
      <th>No</th>
      <th class="hidden">Tanggal</th>
      <th>Nama</th>
      <th class="hidden">Alamat</th>
      <th class="hidden">Telp</th>
      <th>Pengiriman</th>
      <th>Pembayaran</th>
      <th>Bank</th>
      <th>Status</th>
      <th>Action</th>
      <th>Barang</th>
    </tr>
  </thead>
  <tbody>
    @php 
      $i=1
    @endphp
    @foreach($order as $table)
    <tr>
      <td scope="row">{{$loop -> iteration}}</td>
      <td class="hidden">{{date("j-m-Y",strtotime($table->updated_at))}}</td>
      <td>{{$table->nama}}</td>
      <td class="hidden">{{$table->alamat}}</td>
      <td class="hidden">{{$table->telp}}</td>
      <td>{{$table->pengiriman}}</td>
      <td>{{$table->metode_bayar}}</td>
      @if ($table->metode_bayar == "transfer bank")
      <td>{{$table->bank}}</td>
      @else
      <td class="hidden">{{$table->metode_bayar}}</td>
      @endif
      <td>
        @if ($table->status == 0)
          <a href="{{url('order/status/'.$table->id_order)}}" class="btn btn-danger">Belum Dibayar</a>
        @else
          <a href="{{url('order/status/'.$table->id_order)}}" class="btn btn-success">Sudah Dibayar</a>
        @endif
      </td>
      <td>
        <a href="{{ url('order/delete/'.$table->id_order.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
      </td>
      <td>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#det{{$table->id_order}}">Show</button>
      </td>
    </tr>
    @php
    $detail = DB::table('tb_order-detail as a')->join('tb_barang as b','a.id_barang','b.id')->selectraw('a.*,b.nama as nama_barang')->where('id_order',$table->id_order)->get();
    foreach ($detail as $a) {
      echo'
    <tr class="table-info collapse multi-collapse" id="det'.$table->id_order.'">
      <td>No</td>
      <td>Nama Barang</td>
      <td>Harga</td>
      <td>Qty</td>
      <td class="hidden">Diskon</td>
      <td class="hidden">Diskon Nominal</td>
      <td class="hidden">Total</td>
    </tr>
    <tr class="table-info collapse multi-collapse" id="det'.$table->id_order.'">
      <td scope="row">'.$i++.'</td>
      <td>'.$a->nama_barang.'</td>
      <td>Rp.'.number_format($a->harga,0,',','.').'</td>
      <td>'.$a->qty.'</td>
      <td class="hidden">'.$a->diskon.'%</td>
      <td class="hidden">Rp.'.number_format($a->diskon_nominal,0,',','.').'</td>
      <td class="hidden">Rp.'.number_format($a->total,0,',','.').'</td>
    </tr>
      ';
    }
    @endphp
    @endforeach
  </tbody>
</table>
</div>
@endsection