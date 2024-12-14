<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class PelangganCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        if(count($request->all())>0){
            $pelanggan = DB::table('tb_pelanggan')
            ->orderBy('nama', 'asc')
            ->when($search,function($q,$search){
                return $q->where('nama',$search);
            })
            ->paginate(5);
        }else{
            $pelanggan = DB::table('tb_pelanggan')->orderBy('nama', 'asc')->paginate(5);
        }
        return view('pelanggan.frm_pelanggan',compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan/create_pelanggan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pelanggan::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
        ]);

        return redirect('pelanggan/frm_pelanggan') -> with('pesan','Tambah Pelanggan Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit($idcari)
    {
        $pelanggan=Pelanggan::find($idcari);
        return view('pelanggan.edit_pelanggan',compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        Pelanggan::where('id',$pelanggan->id)
        ->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
        ]);
        return redirect('pelanggan/frm_pelanggan')->with('pesan','Edit Data Tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        Pelanggan::destroy($pelanggan->id);
        return redirect('pelanggan/frm_pelanggan')->with('error','Data Terhapus');
    }
}
