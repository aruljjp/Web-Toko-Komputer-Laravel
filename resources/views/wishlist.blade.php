@extends('layout2.template')
@section('content')
<style>
    /* h1{text-align: center;margin: 10px} */
    .nowishlist{text-align: center;margin-top: 200px}
</style>
<div class="container">
    <div class="row" style="margin:30px">
        @php
            $wishlist = DB::table('tb_wishlist')->get();
        @endphp
        @if ($wishlist->count() > 0)
        <div class="card">
            <div class="card-header">
                <h5><i class="fa-solid fa-heart" style="color: red"></i> Wishlist</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('/homepage/simpan')}}">
                @csrf
                <table class="table-bordered" style="margin:10px">
                    @foreach ($wishlist as $wl)
                    <tbody>
                        <tr>
                            <td><img src="{{asset('/images/'.$wl->foto)}}" alt="" style="width:100px;height:100px"></td>
                            <td>{{$wl->nama}}</td>
                            <td>{{$wl->kategori}}</td>
                            <td>
                                <label for="">Diskon</label>
                                <input type="number" readonly class="form-control" name="diskon" id="diskon" value="{{$wl->diskon}}">
                            </td>
                            <td>{{$wl->stok}}</td>
                            <td>
                                <label for="">Harga</label>
                                <input type="number" readonly class="form-control" name="harga" id="harga" value="{{$wl->harga}}">
                            </td>
                            <td>
                                <label for="">Jumlah</label>
                                <input type="number" class="form-control" name="qty" id="qty">
                            </td>
                            <td><button type="submit" class="btn btn-success"><i class="fas fa-cart-plus"></i> Add To Chart</button></td>
                            <td><a href="{{ url('wishlist/delete/'.$wl->id.'') }}" class="btn btn-danger">Delete</a></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                </form>
            </div>
        </div>
        @else
            <div class="nowishlist">
                <h1>Belum ada wishlist!!!</h1>
            </div>
        @endif
    </div>
</div>
@endsection