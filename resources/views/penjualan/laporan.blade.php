@extends('layout.template')

@section("page_title","Laporan Penjualan")
@section('content')
<style>
  thead{background-color: greenyellow;}
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
<a class="btn btn-primary" href="{{url('penjualan/cetak_laporan')}}" target="_blank" role="button" style="margin-bottom: 10px"><i class="fas fa-print"></i></a>
@endif
<table class="table">
  <thead>
    <tr class="table-success">
      <th>No</th>
      {{-- <th class="hidden">Nota</th> --}}
      <th class="hidden">Tanggal</th>
      <th>Nama Pelanggan</th>
      <th>Action</th>
      <th>Barang</th>
    </tr>
  </thead>
  <tbody>
    @php
      $i=1
    @endphp
    @foreach($penjualan as $table)
    <tr>
      <td scope="row">{{$loop -> iteration}}</td>
      {{-- <td class="hidden">{{$table->nota}}</td> --}}
      <td class="hidden">{{date("j-m-Y",strtotime($table->updated_at))}}</td>
      <td>{{$table->nama_pelanggan}}</td>
      <td>
        <a href="{{ url('penjualan/frm_penjualan/'.$table->id_penjualan.'') }}"><span class="badge bg-success"><i class="fas fa-pencil-alt"></i></span></a>
        <a href="{{ url('penjualan/delete/'.$table->id_penjualan.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
      </td>
      <td>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#det{{$table->id_penjualan}}">Show</button>
      </td>
    </tr>
    @php
    $detail = DB::table('tb_penjualan-detail as c')->join('tb_barang as d','c.id_barang','d.id')->selectraw('c.*,d.nama as nama_barang')->where('id_penjualan',$table->id_penjualan)->get();
    foreach ($detail as $a) {
      echo'
    <tr class="table-warning collapse multi-collapse" id="det'.$table->id_penjualan.'">
      <td>No</td>
      <td>Nama Barang</td>
      <td>Harga</td>
      <td>Qty</td>
      <td class="hidden">Diskon Nominal</td>
      <td class="hidden">Total</td>
    </tr>
    <tr class="table-warning collapse multi-collapse" id="det'.$table->id_penjualan.'">
      <td scope="row">'.$i++.'</td>
      <td>'.$a->nama_barang.'</td>
      <td>Rp.'.number_format($a->harga,0,',','.').'</td>
      <td>'.$a->qty.'</td>
      <td class="hidden">Rp.'.number_format($a->diskon_nominal,0,',','.').'</td>
      <td class="hidden">Rp.'.number_format($a->total,0,',','.').'</td>
    </tr>
      ';
    }
    @endphp
    @endforeach
  </tbody>
</table>
<div class="pull-left">
  {{$penjualan->appends($_GET)->links() }}
</div>
@endsection