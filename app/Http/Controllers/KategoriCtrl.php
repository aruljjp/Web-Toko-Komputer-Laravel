<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class KategoriCtrl extends Controller
{
    public function form_kategori(Request $request)
    {
        $kategori = DB::table('tb_kategori')->orderBy('kategori','asc')->paginate(8);
        return view('kategori.data_kategori',compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create_kategori');
    }

    public function store(Request $request)
    {
        // $foto=$request->file('foto');
        // $nama_foto=$foto->getClientOriginalName();
        // $foto->move(public_path()."/images/",$nama_foto);

        DB::table('tb_kategori')->insert([
            'kategori'=>$request->kategori,
        ]);
        return redirect('kategori/data_kategori') -> with('pesan','Tambah Kategori Tersimpan');
    }

    public function form_barang($id)
    {
        $barang = DB::table('tb_barang')->where('id_kategori','=',$id)->paginate(8);


        return view('kategori.data_barang',compact('barang'));
    }

    public function destroy($id)
    {
        DB::table('tb_kategori')->where('id',$id)->delete();
        return redirect('kategori/data_kategori')->with('error','Data kategori Terhapus');
    }

}
