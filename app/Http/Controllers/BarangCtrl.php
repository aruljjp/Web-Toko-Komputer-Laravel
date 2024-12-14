<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class BarangCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari=$request->cari;
        $search=$request->search;
        if(count($request->all())>0){
            $barang = DB::table('tb_barang as a')
            ->join('tb_kategori as b','a.id_kategori','b.id')
            ->when($search,function($q,$search){
                return $q->where('a.nama',$search);
            })
            ->when($search,function($q,$search){
                return $q->where('b.kategori',$search);
            })
            ->paginate(5);
        }else{
            $barang = DB::table('tb_barang as a')->join('tb_kategori as b','a.id_kategori','b.id')->select('a.*','b.kategori')->paginate(5);
        }
        return view('barang.frm_barang',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = DB::table('tb_kategori')->get();
        return view('barang.create_barang',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $foto=$request->file('foto');
        $nama_foto=$foto->getClientOriginalName();
        $foto->move(public_path()."/images/",$nama_foto);

        Barang::create([
            'nama'=>$request->nama,
            'id_kategori'=>$request->id_kategori,
            'harga'=>$request->harga,
            'diskon'=>$request->diskon,
            'stok'=>$request->stok,
            'keterangan'=>$request->keterangan,
            'foto'=>$nama_foto,
        ]);
        return redirect('barang/frm_barang') -> with('pesan','Tambah Barang Tersimpan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($idcari)
    {
        $barang=Barang::find($idcari);
        $kategori = DB::table('tb_kategori')->get();
        return view('barang/edit_barang',compact('barang','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        if($request->file('foto')!= ""){
            $foto=$request->file('foto');
            $nama_foto=$foto->getClientOriginalName();
            $foto->move(public_path()."/images/",$nama_foto);
        }else{
            $nama_foto= $request->oldfoto;
        }

        Barang::where('id',$barang->id)
        ->update([
            'nama'=>$request->nama,
            'id_kategori'=>$request->id_kategori,
            'harga'=>$request->harga,
            'diskon'=>$request->diskon,
            'stok'=>$request->stok,
            'keterangan'=>$request->keterangan,
            'foto'=>$nama_foto,
        ]);
        return redirect('barang/frm_barang')->with('pesan','Edit Data Tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        Barang::destroy($barang->id);
        return redirect('barang/frm_barang')->with('error','Data Barang Terhapus');
    }
}
