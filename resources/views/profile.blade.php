@extends('layout2.template')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->level == null )
                    <div class="text-center">
                        <img src="{{asset('/uploads/'.Auth::user()->foto)}}">
                    </div>                
                    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                    <p class="text-muted text-center">{{Auth::user()->level}}</p>
                    @else
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection