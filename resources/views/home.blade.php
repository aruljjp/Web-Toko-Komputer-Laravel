@extends('layout.template')
@section("page_title","Home")

@section('content')
@if(session('pesan'))
<div class="alert alert-success" role="alert">
  {{session('pesan')}}
</div>
@endif
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$tot_plg}}</h3>

        <p>Total Pelanggan</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-stalker"></i>
      </div>
      <a href="{{url('pelanggan/frm_pelanggan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$tot_brg}}</h3>

        <p>Total Data Barang</p>
      </div>
      <div class="icon">
        <i  class="ion ion-cube"></i>
      </div>
      <a href="{{url('barang/frm_barang')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        @php
          $pjl = DB::table('tb_penjualan')->get();
        @endphp
        <h3>{{$pjl->count()}}</h3>

        <p>Total Penjualan</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{url('penjualan/laporan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        @php
          $brg = DB::table('tb_penjualan-detail')->get();
        @endphp
        <h3>{{$brg->count()}}</h3>

        <p>Total Barang Dijual</p>
      </div>
      <div class="icon">
        <i class="ion ion-pricetags"></i>
      </div>
      <a href="{{url('penjualan/laporan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
<div class="col-md-12">
  <!-- Bar chart -->
  <div class="card" style="margin-left: 1px;margin-right:1px;margin-top:1px">
    <div class="card-header">
      <h3 class="card-title">
        Grafik Penjualan
      </h3>
    </div>
    <div class="container">
      <canvas class="chart" id="myChart" width="100" height="30"></canvas>
    </div>
    <!-- /.card-body-->
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [
      <?php
        $hari1 = Carbon\Carbon::now()->sub(7,'days')->toDateString();
        $hari2 = Carbon\Carbon::now()->sub(6,'days')->toDateString();
        $hari3 = Carbon\Carbon::now()->sub(5,'days')->toDateString();
        $hari4 = Carbon\Carbon::now()->sub(4,'days')->toDateString();
        $hari5 = Carbon\Carbon::now()->sub(3,'days')->toDateString();
        $hari6 = Carbon\Carbon::now()->sub(2,'days')->toDateString();
        $hari7 = Carbon\Carbon::now()->sub(1,'days')->toDateString();
        $hari8 = Carbon\Carbon::now()->toDateString();

        // $bln = Carbon\Carbon::now()->format('m');
        // $thn = Carbon\Carbon::now()->format('Y');
        // $a = $hari.'-'.$bln.'-'.$thn;
        // $a ="aaaaaaaaaaa";
        // echo"aaaa";
        echo "'".$hari1."',"."'".$hari2."',"."'".$hari3."',"."'".$hari4."',"."'".$hari5."',"."'".$hari6."',"."'".$hari7."',"."'".$hari8."',";
      ?>
    ],
    datasets: [{
      label: 'pelanggan',
      data: [
        <?php
          $hari1 = Carbon\Carbon::now()->sub(7,'days')->toDateString();
          $hari2 = Carbon\Carbon::now()->sub(6,'days')->toDateString();
          $hari3 = Carbon\Carbon::now()->sub(5,'days')->toDateString();
          $hari4 = Carbon\Carbon::now()->sub(4,'days')->toDateString();
          $hari5 = Carbon\Carbon::now()->sub(3,'days')->toDateString();
          $hari6 = Carbon\Carbon::now()->sub(2,'days')->toDateString();
          $hari7 = Carbon\Carbon::now()->sub(1,'days')->toDateString();
          $hari8 = Carbon\Carbon::now()->toDateString();
          $dt1 = DB::table('tb_penjualan')->whereDate('created_at',$hari1)->get();
          $d1 = $dt1->count();
          $dt2 = DB::table('tb_penjualan')->whereDate('created_at',$hari2)->get();
          $d2 = $dt2->count();
          $dt3 = DB::table('tb_penjualan')->whereDate('created_at',$hari3)->get();
          $d3 = $dt3->count();
          $dt4 = DB::table('tb_penjualan')->whereDate('created_at',$hari4)->get();
          $d4 = $dt4->count();
          $dt5 = DB::table('tb_penjualan')->whereDate('created_at',$hari5)->get();
          $d5 = $dt5->count();
          $dt6 = DB::table('tb_penjualan')->whereDate('created_at',$hari6)->get();
          $d6 = $dt6->count();
          $dt7 = DB::table('tb_penjualan')->whereDate('created_at',$hari7)->get();
          $d7 = $dt7->count();
          $dt8 = DB::table('tb_penjualan')->whereDate('created_at',$hari8)->get();
          $d8 = $dt8->count();
        ?>
        {{$d1}},{{$d2}},{{$d3}},{{$d4}},{{$d5}},{{$d6}},{{$d7}},{{$d8}}
      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
</script>
@endsection