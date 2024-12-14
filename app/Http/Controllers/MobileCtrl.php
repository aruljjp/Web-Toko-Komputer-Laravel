<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MobileCtrl extends Controller
{
    public function produk($kategori=null)
    {
        if($kategori){
            $produk = DB::table('tb_barang as a')->join('tb_kategori as b','a.id_kategori','b.id')->where('b.kategori',$kategori)->get();
        }else{
            $produk = DB::table('tb_barang as a')->join('tb_kategori as b','a.id_kategori','b.id')->orderBy('b.kategori', 'asc')->get();
        }

        foreach($produk as $key => $value){
            $produk[$key]->foto = asset('/images/'.$value->foto);
        }

        return $produk;
        // $produk = Barang::all();
        // return $produk;
    }

    public function login(Request $req)
    {
        $login = User::where("name",$req->name)->first();

        if($login==null){
            $response = ['status'=>0,'mess'=>'Maaf User tidak ada !'];
        }else{
            if(Hash::check($req->password,$login->password)){
                $response = ['status'=>1,'mess'=>"",'data'=>$login];
            }else{
                $response = ['status'=>0,'mess','Maaf Password salah !'];
            }
        }

        return json_encode($response);
    }

    public function register(Request $req)
    {
        $save = User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>bcrypt($req->password),
        ]);

        if($save){
            $login = User::where('name',$req->name)->first();
            if($login==null){
                $response = ['status'=>0,'mess'=>'Maaf gagal'];
            }else{
                $response = ['status'=>1,'mess'=>'','data'=>$login];
            }
        }else{
            $response = ['status'=>0,'mess'=>'Data gagal disimpan !'];
        }

        return json_encode($response);
    }

    public function saveOrder(Request $req)
    {
        $o = json_decode($req->order,true);
        $detail = json_decode($req->detail,true);
        $kdorder = "O".date("Ymdhis");

        $nama = $o["nama"];
        $alamat = $o["alamat"];
        $telp = $o["telp"];
        $pengiriman = $o["pengiriman"];
        $metode_bayar = $o["metode_bayar"];
        // $bank = $o["bank"];
        // $tgl = $o["tgl"];

        DB::table('tbl_order')->insert([
            "kd_order"=>$kdorder,
            "nama"=>$nama,
            "alamat"=>$alamat,
            "telp"=>$telp,
            "pengiriman"=>$pengiriman,
            "metode_bayar"=>$metode_bayar,
            // "bank"=>$bank,
            // "tgl"=> date("Y-m-d h:i:s",strtotime($tgl)),
            "status"=>0,
        ]);

        foreach($detail as $Detail){
            DB::table('tbl_order-detail')->insert([
                "kd_order"=>$kdorder,
                "id_barang"=>$Detail['id_barang'],
                "nm_barang"=>$Detail['nm_barang'],
                "harga"=>$Detail["harga"],
                "qty"=>$Detail["qty"],
                // "diskon"=>$Detail["diskon"],
                // "diskon_nominal"=>$Detail["diskon_nominal"],
                // "total"=>$Detail["total"],
            ]);
        }

        return json_encode(["status"=>1,"mess"=>"Sukses"]);
    }

    public function getOrder()
    {
        $order = DB::table('tbl_order')->get();
        return $order;
    }

    public function getDetailOrder($kdorder = "")
    {
        $detail = DB::table("tbl_order-detail")->where('kd_order',$kdorder)->get();
        return $detail;
    }

    public function profileupdate(Request $req)
    {
        if(strpos($req->image,"base64")>0){
            if(file_exists(public_path()."/uploads/".$req->id.".jpeg")){
                unlink(public_path()."/uploads/".$req->id.".jpeg");
            }
            $image = explode(",",$req->image);
            $type = str_replace(";base64","",str_replace("data:image/","",$image[0]));
            $file = base64_decode($image[1]);
            $foto = $req->id.".jpeg";
            Storage::disk('uploads')->put($foto,$file);
        }else{
            $foto = $req->id.".jpeg";
        }

        $save = DB::table('users')->where('id',$req->id)->update([
            "name"=>$req->name,
            "email"=>$req->email,
            "foto"=>$foto
        ]);

        $profile = DB::user('users')->where('id',$req->id)->first();
        $profile->foto = $profile->foto != "" ? asset("uploads/".$profile->foto) : "" ; 

        if($save){
            return json_encode(["status"=>1,"mess"=>"Profile Update",
            "data"=>$profile]);
        }else{
            return json_encode(["status"=>0,"mess"=>"Terjadi Kesalahan !"]);
        }
    }
}
