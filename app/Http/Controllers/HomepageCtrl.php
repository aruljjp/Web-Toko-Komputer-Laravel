<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\DB;

class HomepageCtrl extends Controller
{
    public function home(Request $request)
    {
        // $search=$request->search;
        // if(count($request->all())>0){
        //     $barang = DB::table('tb_barang as a')
        //     ->join('tb_kategori as b','a.id_kategori','b.id')
        //     ->when($search,function($q,$search){
        //         return $q->where('kategori',$search);
        //     })
        //     ->paginate(8);
        // }else{

        // }
        $title = "Produk";
        $barang = DB::table('tb_barang as a')->join('tb_kategori as b','a.id_kategori','b.id')->select('a.*','b.kategori')->paginate(5);
        return view('/homepage',compact('barang','title'));
    }

    public function search(Request $request)
    {
        $search=$request->search;
        $barang = DB::table('tb_barang as a')->join('tb_kategori as b','a.id_kategori','b.id')->orderBy('a.id_kategori','asc')->where('kategori',''.$search.'')->paginate(8);
        // $barang = DB::table('tb_barang')->orderBy('kategori','asc')->where('kategori',''.$search.'')->paginate(8);
        
        return view('/homepage',compact('barang'));
    }

    public function about()
    {
        return view('/about');
    }

    public function detail_barang($idcari)
    {
        // $kategori = DB::table('tb_kategori')->first();
        // $id = $kategori->id;
        // $barang = DB::table('tb_barang')->find($idcari);
        $barang = DB::table('tb_barang as a')->join('tb_kategori as b','a.id_kategori','b.id')->selectRaw('a.*,b.kategori as nm_kategori')->where('a.id','=',$idcari)->first();
        // $komen = DB::table('tb_komentar')->orderBy('id','desc')->first();
        // $id = $komen->id;
        
        if(Auth::guest()){
            return view('/error');
        }else{
            $reply = DB::table('tb_reply')->orderBy('created_at','desc')->get();
            // $likes = DB::table('tb_like-komen')->where('id_user',Auth::user()->id)->where('id_komen','=','id_komen')->first();
            $likekomen = DB::table('tb_like-komen')->count();
            return view('/detail_barang',['barang' => $barang,'reply'=>$reply,'likekomen'=>$likekomen]);
        }
    }

    public function handphone()
    {
        $barang=DB::table('tb_barang as a')->join('tb_kategori as b','a.id_kategori','b.id')->where('b.kategori','=','Handphone')->paginate(8);
        return view('kategori2/handphone',compact('barang'));
    }

    public function simpan_komentar(Request $req,$id)
    {
        $barang = DB::table('tb_barang')->where('id','=',$id)->first();
        $id = $barang->id;

        if(Auth::guest()){
            return view('/error');
        }else{
            DB::table('tb_komentar')->insert([
                'id_barang'=>$id,
                'id_user'=>Auth::user()->id,
                'name'=>Auth::user()->name,
                'konten'=>$req->konten,
                'profile_foto'=>Auth::user()->foto,
                'level'=>Auth::user()->level,
            ]);
    
            return redirect()->back();
        }
    }

    public function balas_komentar(Request $req,$id)
    {
        $barang = DB::table('tb_barang')->where('id','=',$id)->first();
        $idbarang = $barang->id;
        
        if(Auth::guest()){
            return view('/error');
        }else{
            DB::table('tb_reply')->insert([
                'id_barang'=>$idbarang,
                'id_komen'=>$req->id_komen,
                'name'=>Auth::user()->name,
                'konten'=>$req->konten,
                'profile_foto'=>Auth::user()->foto,
                'level'=>Auth::user()->level,
            ]);
            return redirect()->back();
        }
    }

    public function halaman_error()
    {
        return view('/error');
    }

    public function likekomen($id)
    {
        $like = DB::table('tb_like-komen')->where('id_komen',$id)->where('id_user',Auth::user()->id)->first();

        if($like)
        {
            DB::table('tb_like-komen')->where('id_user',Auth::user()->id)->delete();
            return redirect()->back();
        }else{
            DB::table('tb_like-komen')->insert([
                'id_komen'=>$id,
                'id_user'=>Auth::user()->id,
                'nama'=>Auth::user()->name,
            ]);
            return redirect()->back();
        }

    }

    public function hapus_komen($id)
    {
        $user= DB::table('tb_komentar')->first();
        if($user->id_user == Auth::user()->id)
        {
            DB::table('tb_komentar')->where('id','=',$id)->where('id_user',Auth::user()->id)->delete();
            return redirect()->back();
        }else{
            return redirect()->back()->with('danger','Maaf Gagal diHapus!!!');
        }
    }

    public function profile()
    {
        $profile = DB::table('tb_profile')->get();
        return view('/profile',['profile'=>$profile]);
    }

    // public function wishlist()
    // {
    //     $wishlist = DB::table('tb_wishlist as a')->join('tb_barang as b','a.id_barang','b.id')->selectRaw('a.*,b.nama as nama_barang')->get();
    //     return view;('/wishlist',['wishlist' => $wishlist]);
    // }

}
