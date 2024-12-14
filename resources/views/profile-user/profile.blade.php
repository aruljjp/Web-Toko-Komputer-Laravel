@extends('layout.template')

@section("page_title","Profile")
@section('bc', 'Profile')
@section('subbc', 'Profile')
@section('content')
<style>
    .button{margin-top:5px;margin-bottom: 5px}
    .reply{margin:5px}
</style>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @foreach($profile as $profiles)
                <div class="text-center">
                    <img src="{{asset('/uploads/'.$profiles->foto)}}">
                </div>                
                <h3 class="profile-username text-center">{{$profiles->name}}</h3>
                <p class="text-muted text-center">{{$profiles->level}}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Nama Lengkap</b>
                        <p>{{$profiles->nama_lengkap}}</p>
                      </li>
                    <li class="list-group-item">
                      <b>Telepon</b>
                      <p>{{$profiles->telp}}</p>
                    </li>
                    <li class="list-group-item">
                      <b>Alamat</b>
                      <p>{{$profiles->alamat}}</p>
                    </li>
                    <li class="list-group-item">
                      <b>Jenis Kelamin</b>
                      <p>{{$profiles->jk}}</p>
                    </li>
                    <li class="list-group-item">
                      <b>Tanggal Lahir</b>
                      <p>{{$profiles->tgl_lahir}}</p>
                    </li>
                    <li class="list-group-item">
                        <b>Agama</b>
                        <p>{{$profiles->agama}}</p>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-8" style="margin-left: 0%">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#komentar" data-toggle="tab">Komentar</a></li>
                <li class="nav-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-left: 50px">
                    Edit Profile
                </button></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="komentar">
                    <!-- Post -->
                    <div class="post">
                        @php
                            $komens = DB::table('tb_komentar as a')->join('tb_barang as b','a.id_barang','b.id')->selectraw('a.*,b.nama as nm_barang')->orderBy('created_at',"desc")->get();
                            $k = DB::table("tb_komentar")->count();
                        @endphp
                        @foreach ($komens as $komen)
                        @if($komen!=null)
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('/uploads/'.$komen->profile_foto)}}" alt="user image">
                            <span class="username">
                                <a href="#">{{$komen->name}}</a>
                                <p>{{$komen->level}}</p>
                            </span>
                            <span class="description">{{$komen->nm_barang}} - {{\Carbon\Carbon::parse($komen->created_at)->diffForHumans()}}</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            {{$komen->konten}}
                        </p>
                        <p>
                            <span class="float-right">
                                <i class="far fa-comments mr-1"></i> Comments ({{$k}})
                            </span>
                        </p>
                        <form method="POST" action="{{url("/profile-user/profile")}}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id_komen" value="{{$komen->id}}">
                                <input type="hidden" name="id_barang" value="{{$komen->id_barang}}">
                                <textarea class="form-control" name="konten" id="konten" cols="10" rows="3" placeholder="Type a komentar"></textarea>
                                <div class="button">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                {{-- <input class="form-control form-control-sm" type="text" id="konten" name="konten" placeholder="Type a comment"> --}}
                            </div>
                        </form>
                        @php
                            $replys = DB::table('tb_reply')->orderBy('created_at','desc')->get()
                        @endphp
                        @foreach ($replys as $reply)
                        @if ($reply->id_komen == $komen->id)
                            <div class="reply">
                                <p><a href="#">{{$reply->name}}</a>&ensp;{{$reply->konten}}<br><span class="timestamp">{{\Carbon\Carbon::parse($reply->created_at)->diffForHumans()}}</span></p>
                            </div>
                        @endif
                        @endforeach
                        @else
                        <h1>NOT KOMENTAR</h1>
                        @endif
                        @endforeach
                    </div>
                    <!-- /.post -->
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                          <form method="POST" action="{{ url('/profile-user/save') }}">
                            @csrf
                            <input type="hidden" class="form-control" id="id_profile" name="id_profile">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{$profiles->nama_lengkap}}">
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="number" class="form-control" id="telp" name="telp" value="{{$profiles->telp}}">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" cols="10" rows="5" value="{{$profiles->alamat}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control" value="{{$profiles->jk}}">
                                    <option selected>Pilih Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal lahir</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="{{$profiles->tgl_lahir}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <select name="agama" id="agama" class="form-control" value="{{$profiles->agama}}">
                                    <option selected>Pilih Agama</option>
                                    <option value="agama islam">Agama Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="katholik">Katholik</option>
                                    <option value="hindhu">Hindhu</option>
                                    <option value="buddha">Buddha</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                            <button type="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
                {{-- <div class="tab-pane" id="settings">
                    <form method="POST" action="{{url("/profile-user/profile")}}">
                        @csrf
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="number" class="form-control" id="telp" name="telp">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="10" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control">
                                <option selected>Pilih Jenis Kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal lahir</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="tgllahir" id="tgllahir">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" id="agama" class="form-control">
                                <option selected>Pilih Agama</option>
                                <option value="agama islam">Agama Islam</option>
                                <option value="kristen">Kristen</option>
                                <option value="katholik">Katholik</option>
                                <option value="hindhu">Hindhu</option>
                                <option value="buddha">Buddha</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div> --}}
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
    </div>
    {{-- <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3>Setting</h3>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control" id="telp" name="telp">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="10" rows="10"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
</div>
<script>
    function buka(id){ 
        var url= "{{url('profile-user/get')}}";
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
                $('#id_profile').val(id);
                $('#nama_lengkap').val(data.nama_lengkap);
                $('#telp').val(data.telp);
                $('#alamat').val(data.alamat);
                $('#jk').val(data.jk);
                $('#tgllahir').val(data.tgllahir);
                $('#agama').val(data.agama);
			},
            error:function(err){
                console.log(err);
            }
		});
	}; 
</script>
@endsection
