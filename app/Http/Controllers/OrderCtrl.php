<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\Auth;

class OrderCtrl extends Controller
{

    public function create_order()
    {
        return view('order/frm_order');
    }

    public function save_order(Request $req,$id)
    {
        $diskon_nominal = $req->harga*($req->diskon/100);
        $tot = $req->harga*$req->qty-$diskon_nominal;

        $barang = DB::table('tb_barang')->where('id','=',$id)->first();
        $id_barang = $barang->id;

        if(Auth::guest()){
            return view('/error');
        }else{
            DB::table('tb_tampung-detail')->where('id','=',$id)->insert([
                'id_user'=>Auth::user()->id,
                'id_barang'=>$id_barang,
                'harga'=>$req->harga,
                'qty'=>$req->qty,
                'diskon'=>$req->diskon,
                'diskon_nominal'=>$diskon_nominal,
                'total'=>$tot,
            ]);
    
            // $barang = Barang::find($id_barang);
            // $barang->stok -= $req->qty;
            // $barang->save();
            
            return redirect('/homepage')->with('pesan','Order Telah Di Tambahkan');
            
        }
    }

    public function store_order(Request $req)
    {

        DB::table('tb_order')->insert([
            'nama'=>$req->nama,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'pengiriman'=>$req->pengiriman,
            'bank'=>$req->bank,
            'metode_bayar'=>$req->metode_bayar,
            'status_bayar'=>0,
        ]);
        $o = DB::table('tb_order')->orderBy('id','desc')->first();
        $id = $o->id;
        $detail = DB::table('tb_tampung-detail')->where('id_user',Auth::user()->id)->get();
        foreach($detail as $data){
            DB::table('tb_order-detail')->insert([
                'id_order'=>$id,
                'id_barang'=>$data->id_barang,
                'harga'=>$data->harga,
                'qty'=>$data->qty,
                'diskon'=>$data->diskon,
                'diskon_nominal'=>$data->diskon_nominal,
                'total'=>$data->total,
            ]);

            $barang = Barang::find($data->id_barang);
            $barang->stok -= $data->qty;
            $barang->save();
        }
        DB::table('tb_tampung-detail')->where('id_user',Auth::user()->id)->delete();

        return redirect('order/data_pesanan') -> with('pesan','Pesanan Telah Tersimpan');
    }

    public function delete($id)
    {
        DB::table('tb_tampung-detail')->where('id', '=', $id)->delete();
        return redirect('order/frm_order')->with('delete','Data Order Terhapus');
    }

    public function data_order()
    {
        $order= DB::table('tb_order')->get();
        return view('order/data_order',compact('order'));
    }

    public function data_pesanan()
    {
        $order= DB::table('tb_order')->get();
        return view('order/data_pesanan',compact('order'));
    }

    public function hapus($id)
    {
        DB::table('tb_order-detail')->where('id_order', '=', $id)->delete();
        DB::table('tb_order')->where('id', '=', $id)->delete();
        return redirect('order/data_order')->with('delete','Data Pesanan Terhapus');
    }

    public function status($id)
    {
        $data = DB::table("tb_order")->where("id",$id)->first();
        $status_now = $data->status;

        if($status_now == 1 ){
            DB::table('tb_order')->where('id',$id)->update([
                'status_bayar'=>0
            ]);
        }else{
            DB::table('tb_order')->where('id',$id)->update([
                'status_bayar'=>1
            ]);
        }
        return redirect('order/data_order')->with('pesan','Status Telah diubah');
    }

    public function detail_pesanan()
    {
        return view('order/detail_pesanan');
    }
}
