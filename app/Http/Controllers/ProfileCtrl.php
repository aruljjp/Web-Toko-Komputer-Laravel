<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileCtrl extends Controller
{
    public function profile()
    {
        $profile = DB::table('tb_profile')->get();

        return view('profile-user/profile',['profile'=>$profile]);
    }

    public function get(Request $req)
    {
        $profile = DB::table('tb_profile')->where('id',$req->id)->first();
        echo json_encode($profile);
    }

    public function save_profile(Request $req)
    {
        // $data = array();
        // $data['name'] =  Auth::user()->name;
        // $data['level'] =  Auth::user()->level;
        // $data['telp'] =  $req->telp;
        // $data['alamat'] =  $req->alamat;
        // $data['jk'] =  $req->jk;
        // $data['tgllahir'] =  $req->tgllahir;
        // $data['agama'] =  $req->agama;
        // $data['foto'] =  Auth::user()->foto;
        
        // DB::table('tb_profile')->insert($data);
      
        DB::table('tb_profile')->updateOrInsert([
            "name"=> Auth::user()->name,
            "level"=> Auth::user()->level,
            "nama_lengkap"=>$req->nama_lengkap,
            "telp"=> $req->telp,
            "alamat"=> $req->alamat,
            "jk"=> $req->jk,
            "tgl_lahir"=> $req->tgl_lahir,
            "agama"=> $req->agama,
            "foto"=> Auth::user()->foto,
        ]);
        return redirect('profile-user/profile');
    }

    public function save_reply(Request $req)
    {
        DB::table('tb_reply')->insert([
            "id_komen"=>$req->id_komen,
            "id_barang"=>$req->id_barang,
            'name'=>Auth::user()->name,
            "konten"=>$req->konten,
            "profile_foto"=>Auth::user()->foto,
            "level"=>Auth::user()->level,
        ]);
        return redirect()->back();
    }
}
