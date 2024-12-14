@extends('layout.template')

@section("page_title","Laporan Pembelian")
@section('content')
<style>
  thead{background-color:skyblue;}
  th{color:black;}
  tbody{background-color: white;}
  td{color: black;}
  .pull-left{float: left;}
  @media screen and (max-width: 900px)  {
    .hidden{
      display:none;
    }
  }
</style>
@if(session('delete'))
<div class="alert alert-danger" role="alert">
  {{session('delete')}}
</div>
@endif
@if(Auth::user()->level=='admin')
<a class="btn btn-primary" href="{{url('pembelian/cetak_laporan')}}" target="_blank" role="button" style="margin-bottom: 10px"><i class="fas fa-print"></i></a>
@endif
<table class="table table-bordered" border="1">
  <thead>
    <tr class="table-primary">
      <th>No</th>
      <th class="hidden">Tanggal</th>
      <th>Nama Rekanan</th>
      <th class="hidden">Alamat</th>
      <th class="hidden">Telp</th>
      <th>Action</th>
      <th>Barang</th>
    </tr>
  </thead>
  <tbody>
    @php 
      $i=1
    @endphp
    @foreach($pembelian as $table)
    <tr>
      <td scope="row">{{$loop -> iteration}}</td>
      <td class="hidden">{{date("j-m-Y",strtotime($table->updated_at))}}</td>
      <td>{{$table->nama_rekanan}}</td>
      <td class="hidden">{{$table->alamat}}</td>
      <td class="hidden">{{$table->telp}}</td>
      <td>
        <a href="{{ url('pembelian/frm_pembelian/'.$table->id_pembelian.'') }}"><span class="badge bg-success"><i class="fas fa-pencil-alt"></i></span></a>
        <a href="{{ url('pembelian/delete/'.$table->id_pembelian.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
      </td>
      <td>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#det{{$table->id_pembelian}}">Show</button>
      </td>
    </tr>
    @php
    $detail = DB::table('tb_pembelian-detail as c')->join('tb_barang as d','c.id_barang','d.id')->selectraw('c.*,d.nama as nama_barang')->where('id_pembelian',$table->id_pembelian)->get();
    foreach ($detail as $a) {
      echo'
    <tr class="table-info collapse multi-collapse" id="det'.$table->id_pembelian.'">
      <td>No</td>
      <td>Nama Barang</td>
      <td>Harga</td>
      <td>Qty</td>
      <td class="hidden">Total</td>
    </tr>
    <tr class="table-info collapse multi-collapse" id="det'.$table->id_pembelian.'">
      <td scope="row">'.$i++.'</td>
      <td>'.$a->nama_barang.'</td>
      <td>'.number_format($a->harga,0,',','.').'</td>
      <td>'.$a->qty.'</td>
      <td class="hidden">'.number_format($a->total,0,',','.').'</td>
    </tr>
      ';
    }
    @endphp
    @endforeach
</table>
<div class="pull-left">
  {{$pembelian->appends($_GET)->links() }}
</div>
@endsection