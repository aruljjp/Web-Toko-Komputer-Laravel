@extends('layout2.template')
@section('content')
<style>
    .card{margin-top: 5vh}
    .image-content{width: 350px;height: 350px;float: left;margin-left: 10px}
    .image-content img{width: 350px;height: 350px}
    .km{margin-top:10px}
    .komen{margin-top: 10px}
    .reply{margin-left: 20px}
    .nokomen{text-align: center;margin:20px}
</style>
<div class="container">
    @if(session('danger'))
    <div class="alert alert-danger" role="alert" style="margin-top:30px">
        {{session('danger')}}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ url('/homepage/'.$barang->id.'')}}">
                    @csrf
                    <div class="row">
                        <div class="image-content">
                            <img src="{{asset('/images/'.$barang->foto)}}">
                        </div>
                        <div class="col-md-8">
                            <h2>{{$barang->nama}}</h2>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>{{$barang->nm_kategori}}</td>
                                    </tr>
                                    <tr>
                                        <td>Diskon</td>
                                        <td><input type="number" readonly class="form-control" name="diskon" id="diskon" value="{{$barang->diskon}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>{{$barang->stok}}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td><input type="number" readonly class="form-control" name="harga" id="harga" value="{{$barang->harga}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td><input type="number" class="form-control" name="qty" id="qty"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success btn-lg btn-flat">
                                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                  Add to Cart
                                </button>
                                <div class="btn btn-danger btn-lg btn-flat">
                                <a href="{{ url('/homepage') }}">Kembali</a>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <nav class="w-100">
                                  <div class="nav nav-tabs" id="product-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                                    {{-- <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a> --}}
                                  </div>
                                </nav>
                                <div class="tab-content p-3" id="nav-tabContent">
                                  <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">{{$barang->keterangan}}</div>
                                  {{-- <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> --}}
                                    {{-- <div class="card">
                                        <form action="">
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Comments</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
                                            </div>
                                            <div class="button">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div> --}}
                                    
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Comment</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/detail_barang/'.$barang->id.'') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                {{-- <input type="hidden" name="parent" value="0"> --}}
                                <textarea type="text" class="form-control" id="konten" rows="3" name="konten"></textarea>
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <ul class="list-unstyled activity-list" style="margin-top: 5px">
                        <li>
                            @php
                                $komen = DB::table('tb_komentar')->orderBy('created_at',"desc")->get();
                            @endphp
                            @foreach($komen as $km)
                            @if ($km->id_barang == $barang->id)
                            <div class="komen">
                                <img class="d-flex mr-3 rounded-circle" src="{{asset('/uploads/'.$km->profile_foto)}}" alt="" style="width: 50px">
                                <p>{{$km->name}}<br>{{$km->konten}}<br><span class="timestamp">{{\Carbon\Carbon::parse($km->created_at)->diffForHumans()}}</span></p>
                            </div>
                            {{-- <h5 class="user-name mb-1">
                                {{$km->name}}
                            </h5>
                            <p class="user-comment mb-1">{{$km->konten}}</p>
                            <span class="timestamp">{{\Carbon\Carbon::parse($km->created_at)->diffForHumans()}}</span> --}}
                            <p>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2" style="margin-top:1px">Balas</button>&nbsp;
                                @php
                                    $like = DB::table('tb_like-komen')->where('id_komen','=',$km->id)->where('id_user',Auth::user()->id)->first();
                                @endphp
                                @if($like)
                                <a href="{{url('detail_barang/like/'.$km->id)}}" type="button" class="btn btn-link"><i class="fa-solid fa-thumbs-up"></i>{{$likekomen}}</a>
                                @else
                                <a href="{{url('detail_barang/like/'.$km->id)}}" type="button" class="btn btn-link"><i class="fa-regular fa-thumbs-up"></i></a>
                                @endif
                                <a href="{{url('detail_barang/hapus/'.$km->id)}}" type="button" class="btn btn-link"><i class="fa-solid fa-trash" style="color: red"></i></a>
                            </p>
                            @else
                                <div class="nokomen">
                                    <h4>Komentar masih kosong!!!</h4>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col">
                                  <div class="collapse multi-collapse" id="multiCollapseExample2">
                                    <form method="POST" action="{{ url('/detail_barang/simpan/'.$barang->id.'') }}" style="margin:1px">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3">
                                                <input type="hidden" name="id_komen" value="{{$km->id}}">
                                                <textarea type="text" class="form-control" id="balas-konten" rows="3" name="konten"></textarea>
                                            </div>
                                            <div class="button">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            </div>
                                {{-- <div class="btn-group" style="margin-top:1px">
                                    <a href="#" class="btn btn-primary">Link</a>
                                    <a href="#" class="btn btn-primary" id="btn-balas-konten">Balas</a>
                                </div>
                                <form method="POST" action="{{ url('/detail_barang/simpan/'.$barang->id.'') }}" id="balas-konten" style="display: none;margin-top:5px;margin-bottom:5px">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3">
                                            <input type="hidden" name="parent" value="{{$km->id}}">
                                            <textarea type="text" class="form-control" id="balas-konten" rows="3" name="konten"></textarea>
                                        </div>
                                        <div class="button">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form> --}}
                                @foreach ($reply as $rp)
                                @if ($rp->id_komen == $km->id && $rp->id_barang == $barang->id)
                                <div class="reply">
                                    <p><a href="#">{{$rp->name}} ({{$rp->level}})</a>&ensp;{{$rp->konten}}<br><span class="timestamp">{{\Carbon\Carbon::parse($rp->created_at)->diffForHumans()}}</span></p>
                                </div>
                                @endif
                                @endforeach
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    $(document).ready(function(){
        $('#btn-balas-konten').click(function(){
            $('#balas-konten').toggle('slide');
        });
    });
</script> --}}
@endsection
