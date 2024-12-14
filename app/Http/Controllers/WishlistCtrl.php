<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\Auth;

class WishlistCtrl extends Controller
{
    public function wishlist()
    {
        $wishlist = DB::table('tb_wishlist as a')->join('tb_barang as b','a.id_barang','b.id')->select('b.*')->get();
        return view('wishlist',['wishlist'=>$wishlist]);
    }

    public function add_wishlist($id)
    {
        $love = DB::table('tb_wishlist')->where('id_barang',$id)->where('id_user',Auth::user()->id)->first();

        if($love)
        {
            DB::table('tb_wishlist')->where('id_user',Auth::user()->id)->delete();
            return redirect()->back();
        }
        else
        {
            $barang = DB::table('tb_barang')->where('id','=',$id)->first();
            $id = $barang->id;
            DB::table('tb_wishlist')->insert([
                'id_barang'=>$id,
                'id_user'=>Auth::user()->id,
            ]);
            return redirect()->back();
        }
    }


    public function save_wishlist(Request $req)
    {
        $diskon_nominal = $req->harga*($req->diskon/100);
        $tot = $req->harga*$req->qty-$diskon_nominal;
        
        $wishlist = DB::table('tb_wishlist')->orderBy('id_barang','desc')->first();
        $id_barang = $wishlist->id_barang;

        $barang = DB::table('tb_barang')->orderBy('id','desc')->first();
        $id = $barang->id;

        if(Auth::guest()){
            return view('/error');
        }else{
            DB::table('tb_tampung-detail')->where('id','=','id')->insert([
                'id_user'=>Auth::user()->id,
                'id_barang'=>$id_barang,
                'harga'=>$req->harga,
                'qty'=>$req->qty,
                'diskon'=>$req->diskon,
                'diskon_nominal'=>$diskon_nominal,
                'total'=>$tot,
            ]);
            DB::table('tb_wishlist')->where('id_user',Auth::user()->id)->delete();
    
            // $barang = Barang::find($id_barang);
            // $barang->stok -= $req->qty;
            // $barang->save();
            
            return redirect('/homepage')->with('pesan','Wishlist Telah Di Tambahkan');
            
        }
    }

    public function delete_wishlist($id)
    {
        DB::table('tb_wishlist')->where('id_barang', '=', $id)->delete();
        return redirect('/wishlist')->with('delete','Data Order Terhapus');
    }
}
