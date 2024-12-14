@extends('layout2.template')
@section('content')
<style>
  th{color:black;}
  tbody{background-color: white;}
  td{color: black;}
  thead{background-color: skyblue}
  .nopesanan{text-align: center;margin-top:200px}
  @media screen and (max-width: 900px)  {
    .hidden{
      display:none;
    }
  }
</style>
<div class="container">
  <div class="col-md-12">
    <div class="row" style="margin-top: 50px">
      {{-- <a href="{{ url('/homepage') }}"><button type="button" class="btn btn-danger" style="margin-bottom: 5px">Back</button></a> --}}
      @php
        $order = DB::table('tb_order')->get();
      @endphp
      @if($order->count() > 0)
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr scope="col">
              <th>No</th>
              <th class="hidden">Tanggal</th>
              <th>Nama</th>
              <th class="hidden">Alamat</th>
              <th class="hidden">Telp</th>
              <th>Pengiriman</th>
              @php
                $orders = DB::table('tb_order')->first();
              @endphp
              @if ($orders->metode_bayar == "transfer bank" )
              <th>Bank</th>
              @else
              <th>Pembayaran</th>
              @endif
              <th>Status</th>
              <th>Total</th>
              {{-- <th>Action</th> --}}
            </tr>
          </thead>
          <tbody>
            @php 
              $total = DB::table('tb_order-detail')->orderBy('id_order','desc')->sum('total');
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
              @if ($table->metode_bayar == "transfer bank")
              <td>{{$table->bank}}</td>
              @else
              <td>{{$table->metode_bayar}}</td>
              @endif
              <td>
              @if($table->status_bayar == 1)
              <span class="badge text-bg-success">Sudah dibayar</span>
              @else
              <span class="badge text-bg-danger">Belum dibayar</span>
              @endif
              </td>
              <td>Rp.{{number_format($total,0,',','.')}}</td>    
              {{-- <td><a href="{{url("order/detail_pesanan")}}" class="btn btn-success" href="#" role="button">Detail</a></td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <div class="nopesanan">
        <h1>Belum ada pesanan!!!</h1>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection