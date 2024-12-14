<?php

namespace App\Http\Controllers;

use App\Models\Rekanan;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class RekananCtrl extends Controller
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
            $rekanan = DB::table('tb_rekanan')
            ->orderBy('nama', 'asc')
            ->when($search,function($q,$search){
                return $q->where('nama',$search);
            })
            ->paginate(5);
        }else{

            $rekanan = DB::table('tb_rekanan')->orderBy('nama', 'asc')->paginate(5);
        }
        return view('rekanan.frm_rekanan',compact('rekanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rekanan/create_rekanan');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Rekanan::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
        ]);

        return redirect('rekanan/frm_rekanan') -> with('pesan','Tambah Rekanan Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rekanan  $rekanan
     * @return \Illuminate\Http\Response
     */
    public function show(Rekanan $rekanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rekanan  $rekanan
     * @return \Illuminate\Http\Response
     */
    public function edit($idcari)
    {
        $rekanan=Rekanan::find($idcari);
        return view('rekanan.edit_rekanan',compact('rekanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rekanan  $rekanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekanan $rekanan)
    {
        Rekanan::where('id',$rekanan->id)
        ->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
        ]);
        return redirect('rekanan/frm_rekanan')->with('pesan','Edit Data Tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rekanan  $rekanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekanan $rekanan)
    {
        Rekanan::destroy($rekanan->id);
        return redirect('rekanan/frm_rekanan')->with('error','Data Terhapus');
    }
}
