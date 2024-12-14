@extends('layout.template')
@section("page_title","Transaksi Penjualan")

@section('content')
<style>
    .card-pelanggan{background-color: white;margin-right: 1px;margin-left: 10px;}
    .card-barang{background-color: white;}
    .body-barang{padding-top:10px;padding-right: 1px;padding-left: 1px;padding-bottom: 1px}
    .card-header{background-color: greenyellow;}
    button{margin-top:1px;margin-right: 10px;}
    .button{float: left;margin-top: 30px}
    .alamat input{padding-right: 50px}
    .form-group{width: 500px}
    th{color:black;}
    @media screen and (max-width: 900px)  {
        .hidden{
            display:none;
        }
        .card-pelanggan{
            margin-left: 1px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .card-barang{
            margin-right: 1px;
        }
        .form-group{width: 300px}
    }
</style>
@if(session('success'))
<div class="alert alert-success" role="alert">
{{session('success')}}
</div>
@elseif(session('error'))
<div class="alert alert-danger" role="alert">
{{session('error')}}
</div>
@endif
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6" style="padding-left:1px;padding-right:1px;">
                <div class="card-barang">
                    <div class="card-header">
                        <h4>Order Barang</h4>
                    </div>
                    <div class="body-barang">
                        <div class="table-responsive">
                            <table class="table table-bordered border-dark" width="100%">
                                <thead>
                                    <tr class="table-success">
                                        <th width="15%">Nama Barang</th>
                                        <th width="10%">Harga</th>
                                        <th width="1%">Qty</th>
                                        <th width="10%" class="hidden">Total</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $tampungan = DB::table('tb_tampung-detail as a')->join('tb_barang as b','a.id_barang','b.id')->selectraw('a.*,b.nama as nama_barang')->get();
                                    $grand = 0;
                                @endphp
                                @foreach($tampungan as $table)
                                @php
                                    $grand += $table->total;
                                @endphp
                                <tbody>
                                    <tr>
                                        <td>{{$table->nama_barang}}</td>
                                        <td>Rp.{{number_format($table->harga,0,',','.')}}</td>
                                        <td>{{$table->qty}}</td>
                                        <td class="hidden">Rp.{{number_format($table->total,0,',','.')}}</td>
                                        <td>
                                            <a onclick="buka({{$table->id}})" ><span class="badge bg-success"><i class="fas fa-pencil-alt"></i></span></a>
                                            <a href="{{ url('penjualan/hapus/'.$table->id.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;margin-bottom:10px;"><i class="fa fa-plus"></i>
                                    Tambah Barang
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <form method="POST" action="{{ url('/penjualan/simpan/tampung') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <label>Nama Barang</label>
                                            <select name="id_barang" id="id_barang" class="form-control id_barang">
                                                <option selected>--- Pilih Barang ---</option>
                                                @foreach($barang as $barang)
                                                    <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                                @endforeach
                                            </select>
                                            <label>Harga</label>
                                            <input type="hidden" class="form-control" id="id_tampung" name="id_tampung">
                                            <select name="harga" id="harga" class="form-control">
                                                @php
                                                    $brgs = DB::table('tb_barang')->orderBy('id','asc')->get();
                                                @endphp
                                                <option selected>--- Pilih Harga ---</option>
                                                @foreach($brgs as $brg)
                                                    <option value="{{ $brg->harga }}">{{$brg->nama}} : {{ $brg->harga }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="number" class="form-control" id="harga" name="harga" value="{{ $barang->harga}}"> --}}
                                            <label>Qty</label>
                                            <input type="number" class="form-control" id="qty" name="qty">
                                            <label>Diskon</label>
                                            <select name="diskon" id="diskon" class="form-control">
                                                @php
                                                    $brgs = DB::table('tb_barang')->orderBy('id','asc')->get();
                                                @endphp
                                                <option selected>--- Pilih Diskon ---</option>
                                                @foreach($brgs as $brg)
                                                    <option value="{{ $brg->diskon }}">{{$brg->nama}} : {{ $brg->diskon }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="number" class="form-control" id="diskon" name="diskon"> --}}
                                        </div>
                                        <div class="modal-footer">
                                        <button type="close" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="padding-right: 1px;padding-left:1px">
                @php
                    if($penjualan != ''){
                        $pel = $penjualan->id_pelanggan;
                        $nota = $penjualan->nota;
                        $bayar = $penjualan->bayar;
                    }else{
                        $pel = "";
                        $nota = "";
                        $bayar = "";
                    }
                @endphp
                <div class="card-pelanggan">
                    <div class="card-header">
                        <h4>Total: <b class="grand_total" name="grand_total">RP.{{number_format($grand,0,',','.')}}</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="panel">
                            <div class="row" style="margin-left: 1px;margin-right:1px">
                                <form method="POST" target="_blank" action="{{ url('/penjualan/simpan') }}">
                                @csrf
                                {{-- <div class="form-group">
                                    <label>Nota</label>
                                    <input type="hidden" class="form-control" id="nota" name="nota" value="{{$nota}}">
                                </div> --}}
                                <div class="form-group">
                                    <label for="">Pelanggan</label>
                                    <select name="id_pelanggan" id="id_pelanggan" class="form-control id_pelanggan">
                                        @foreach($pelanggan as $pelanggan)
                                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Uang Bayar</label>
                                    <input type="number" name="bayar" id="bayar" class="form-control" value="{{$bayar}}">
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
<script>
    function buka(id){ 
        var url= "{{url('penjualan/tampung/get')}}";
		$.ajax({
            url: url,
			method: "POST",
			data: {
                id:id
            },
            dataType : "JSON",
			success: function(data){
                // console.log(data);
                $('#exampleModal').modal('show');
                $('#id_tampung').val(id);
                $('#harga').val(data.harga);
                $('#qty').val(data.qty);
			},
            error:function(err){
                console.log(err);
            }
		});
	}; 
</script>
@endsection