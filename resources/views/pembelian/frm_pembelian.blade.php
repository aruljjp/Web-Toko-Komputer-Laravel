@extends('layout.template')

@section("page_title","Transaksi Pembelian")
@section('content')
<style>
    .card-rekanan{background-color: white;margin-right: 1px;margin-left: 10px;}
    .card-barang{background-color: white;}
    .body-barang{padding-top:10px;padding-right: 1px;padding-left: 1px;padding-bottom: 1px;}
    .card-header{background-color:royalblue;color: white;}
    button{margin-top:1px;margin-right: 10px}
    .button{float: left;margin-top: 30px}
    .alamat input{padding-right: 50px}
    .card-body{margin-left: 1px;margin-right: 1px;}
    thead{background-color:skyblue;}
    tbody{background-color: white;}
    th{color:black; }
    .form-group{width: 500px}
    @media screen and (max-width: 900px)  {
        .hidden{
            display:none;
        }
        .card-rekanan{
            margin-left: 1px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .card-barang{
            margin-right: 1px;
        }
        .button{float: right;margin-top: 1px;}
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float:right;margin-bottom:10px;"><i class="fa fa-plus"></i>
                            Tambah Barang
                        </button>
                        <table class="table table-bordered" width='100%'>
                            <thead>
                                <tr>
                                    <th width="15%">Nama Barang</th>
                                    <th width="10%">Harga</th>
                                    <th width="1%">Qty</th>
                                    <th width="10%" class="hidden">Total</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tampungan = DB::table('tbl_tampung_detail as a')->join('tb_barang as b','a.id_barang','b.id')->selectraw('a.*,b.nama as nama_barang')->get();
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
                                    <td class="hidden">{{number_format($table->total,0,',','.')}}</td>
                                    <td>
                                        <a onclick="buka({{$table->id}})" ><span class="badge bg-success"><i class="fas fa-pencil-alt"></i></span></a>
                                        <a href="{{ url('pembelian/hapus/'.$table->id.'') }}"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
                                    </td>
                                </tr>
                                @endforeach
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
                                        <form method="POST" action="{{ url('/pembelian/simpan/tampung') }}">
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
                                            <input type="number" class="form-control" id="harga" name="harga">
                                            <label>Qty</label>
                                            <input type="number" class="form-control" id="qty" name="qty">
                                        </div>
                                        <div class="modal-footer">
                                        <button type="close" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="padding-left: 1px;padding-right:1px">
                @php
                    if($pembelian != ''){
                        $rek = $pembelian->id_rekanan;
                        $alamat = $pembelian->alamat;
                        $telp = $pembelian->telp;
                    }else{
                        $rek = "";
                        $alamat = "";
                        $telp = "";
                    }
                @endphp
                <div class="card-rekanan">
                    <div class="card-header">
                        <h4>Total:<b class="grand_total" nama="grand_total">RP.{{number_format($total,0,',','.')}}</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="panel">
                            <div class="row" style="margin-left: 1px;margin-right:1px">
                                <form method="POST" target="_blank" action="{{ url('/pembelian/simpan') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Rekan</label>
                                    <select name="id_rekanan" id="id_rekanan" class="form-control id_rekanan">
                                        @foreach($rekanan as $rekanan)
                                            <option value="{{ $rekanan->id }}">{{ $rekanan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="alamat">
                                        <label for="">Alamat</label>
                                        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $alamat }}">     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Telp</label>
                                    <input type="number" name="telp" id="telp" class="form-control" value="{{$telp}}">
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
        var url= "{{url('pembelian/tampung/get')}}";
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