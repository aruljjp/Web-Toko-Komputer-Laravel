@extends('layout2.template')
@section('content')
<style>
    .card{background-color: white;margin-right: 1px;margin-left: 10px;}
    .card-barang{background-color:white;color: black;}
    .body-barang{padding-top:10px;padding-right: 1px;padding-left: 1px;padding-bottom: 1px;}
    .card-header{background-color:white;color: black;}
    .card-header h4{text-align: center}
    .button button{float: left;margin-top: 30px;margin-top:1px;margin-right: 10px}
    .alamat input{padding-right: 50px}
    .card-body{margin-left: 1px;margin-right: 1px;background-color: white}
    thead{background-color:aqua;}
    tbody{background-color: white;}
    .form-group{width: 500px}
    th{color:black; }
    @media screen and (max-width: 900px)  {
        .hidden{
            display:none;
        }
        .card{background-color: white;margin-right: 1px;margin-left: 1px;}
        .card-barang{background-color:white;color: black;}
        .body-barang{padding-top:10px;padding-right: 1px;padding-left: 1px;padding-bottom: 1px;}
        .card-header{background-color:white;color: black;}
        .card-header h4{text-align: center}
        .button button{float: left;margin-top: 1px;width: 300px;margin-top:1px;}
        .alamat input{padding-right: 1px}
        .card-body{margin-left: 1px;margin-right: 1px;background-color: white}
        thead{background-color:aqua;}
        tbody{background-color: white;}
        .form-group{width: 300px}
        th{color:black; }
    }
</style>
<div class="container">
    @if(session('delete'))
    <div class="alert alert-danger" role="alert">
    {{session('delete')}}
    </div>
    @endif
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6" style="padding-left:1px;padding-right:1px;">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="body-barang">
                        <a href="{{ url('/homepage') }}"><button type="button" class="btn btn-danger" style="margin-bottom: 10px;margin-left:10px">Back</button></a>
                        <table class="table table-bordered" width='100%'>
                            <thead>
                                <tr>
                                    <th width="15%">Nama Produk</th>
                                    <th width="10%">Harga</th>
                                    <th width="1%">Jumlah</th>
                                    <th width="10%" class="hidden">Diskon Nominal</th>
                                    <th width="10%" class="hidden">Total</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tampungan = DB::table('tb_tampung-detail as a')->join('tb_barang as b','a.id_barang','b.id')->selectraw('a.*,b.nama as nama_barang')->get();
                                    $total = 0;
                                @endphp
                                @foreach($tampungan as $table)
                                @php
                                    $total += $table->total;
                                @endphp
                                <tr>
                                    <td>{{$table->nama_barang}}</td>
                                    <td>{{number_format($table->harga,0,',','.')}}</td>
                                    <td>{{$table->qty}}</td>
                                    <td class="hidden">{{number_format($table->diskon_nominal,0,',','.')}}</td>
                                    <td class="hidden">{{number_format($table->total,0,',','.')}}</td>
                                    <td>
                                        <a href="{{ url('order/hapus/'.$table->id.'') }}"><span class="badge bg-danger">Hapus</span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="padding-left: 1px;padding-right:1px">
                <div class="card">
                    <div class="card-header">
                        <h4>Sub Total : <b class="grand_total" nama="grand_total">RP.{{number_format($total,0,',','.')}}</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="panel">
                            <div class="row" style="margin-left: 1px;margin-right:1px">
                                <form method="POST" action="{{ url('/homepage') }}">
                                @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat">
                                    </div>
                                    <div class="form-group">
                                        <label>No Telp</label>
                                        <input type="text" class="form-control" id="telp" name="telp">
                                    </div>
                                    <div class="form-group">
                                        <label>Pilih Pengiriman</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pengiriman" id="pengiriman" value="JNE">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                              JNE
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pengiriman" id="pengiriman" value="JNT">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                              JNT
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Pilih Pembayaran</label>
                                        <div class="form-check">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pembayaran" id="pembayaran" value="cod">
                                                <label class="form-check-label" for="inlineRadio1">Bayar di Tempat</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pembayaran" id="pembayaran" value="transfer bank">
                                                <label class="form-check-label" for="inlineRadio2">Transfer Bank</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection