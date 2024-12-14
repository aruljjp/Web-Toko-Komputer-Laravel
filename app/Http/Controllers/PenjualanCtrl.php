<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Penjualan;

use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class PenjualanCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan= DB::table('tb_penjualan as a')->leftjoin('tb_pelanggan as b','a.id_pelanggan','b.id')->selectraw('a.*,b.nama as nama_pelanggan')->paginate(10);
        return view('penjualan.laporan',compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjualan= DB::table('tb_tampung')->where('id_user',Auth::user()->id)->first();
        $pelanggan= Pelanggan::all();
        $barang = Barang::all();
        return view('penjualan.frm_penjualan',['barang' => $barang,'pelanggan' => $pelanggan],compact('penjualan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $pjl = DB::table('tb_penjualan')->count();
        $nota = "NT0".$pjl.date("d-m-Y");
        DB::table('tb_penjualan')->insert([
            'id_pelanggan'=>$req->id_pelanggan,
            // 'nota'=>$nota,
            'bayar'=>$req->bayar,
        ]);
        $q = DB::table('tb_penjualan')->orderBy('id_penjualan','desc')->first();
        $id = $q->id_penjualan;
        $detail = DB::table('tb_tampung-detail')->where('id_user',Auth::user()->id)->get();
        foreach($detail as $data){
            DB::table('tb_penjualan-detail')->insert([
                'id_penjualan'=>$id,
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

        return redirect('penjualan/cetak/'.$id.'') -> with('pesan','Tambah Data Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    function get(Request $req)
    {
        $barang = DB::table('tb_tampung-detail')->where('id',$req->id)->first();
        echo json_encode($barang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('tb_penjualan-detail')->where('id','=',$request->id)->update([
            'id_barang'=>$request->id_barang,
            'harga'=>$request->harga,
            'diskon_nominal'=>$request->diskon_nominal,
            'total'=>$request->total,
        ]);
        DB::table('tb_penjualan')->where('')->update([
            'id_pelanggan'=>$request->id_pelanggan,
            // 'nota'=>$request->nota,
            'bayar'=>$request->bayar,
        ]);
        return redirect('penjualan/laporan')->with('pesan','Edit Data Tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('tb_penjualan-detail')->where('id_penjualan', '=', $id)->delete();
        DB::table('tb_penjualan')->where('id_penjualan', '=', $id)->delete();
        return redirect('penjualan/laporan')->with('delete','Data Laporan Terhapus');
    }

    public function simpantampung(Request $req)
    {
        $diskon_nominal = $req->harga*($req->diskon/100);
        $tot = $req->harga*$req->qty-$diskon_nominal;
        
        if($req->id_tampung != ""){
            DB::table('tb_tampung-detail')->where('id',$req->id_tampung)->update([
                'id_user' => Auth::user()->id,
                'id_barang'=>$req->id_barang,
                'harga'=>$req->harga,
                'qty'=>$req->qty,
                'diskon'=>$req->diskon,
                'diskon_nominal'=>$diskon_nominal,
                'total'=>$tot,
            ]);

        }else{
            DB::table('tb_tampung-detail')->insert([
                'id_user' => Auth::user()->id,
                'id_barang'=>$req->id_barang,
                'harga'=>$req->harga,
                'qty'=>$req->qty,
                'diskon'=>$req->diskon,
                'diskon_nominal'=>$diskon_nominal,
                'total'=>$tot,
            ]);
        }

        return redirect('penjualan/frm_penjualan')->with('success','Tambah Barang Tersimpan');
    }

    public function deletetampung($id)
    {
        DB::table('tb_tampung-detail')->where('id','=',$id)->delete();

        return redirect('penjualan/frm_penjualan')->with('error','Data Barang Terhapus');
    }

    public function shownota()
    {
        return view('penjualan.nota');
    }
    function cetaknota($id){

        $penjualan = DB::table("tb_penjualan as a")
        ->join("tb_pelanggan as b","a.id_pelanggan","=","b.id")
        ->where("a.id_penjualan",$id)
        ->get();

        $detail = DB::table("tb_penjualan-detail as a")
        ->join("tb_barang as b","a.id_barang","=","b.id")
        ->where("a.id_penjualan",$id)
        ->get();
        
        return view("penjualan.nota",compact('penjualan','detail'));
    }
    public function edit($idcari)
    {

        $penjualan=DB::table('tb_penjualan')->where('id_penjualan','=',$idcari)->first();
        $detail=DB::table('tb_penjualan-detail')->where('id_penjualan','=',$idcari)->get();
        foreach($detail as $a){
            $tot = $a->harga*$a->qty;
            DB::table('tb_tampung-detail')->insert([
                'id_user' => Auth::user()->id,
                'id_barang'=>$a->id_barang,
                'harga'=>$a->harga,
                'qty'=>$a->qty,
                'diskon'=>$a->diskon,
                'diskon_nominal'=>$a->diskon_nominal,
                'total'=>$tot,
            ]);
        }
        DB::table('tb_tampung')->insert([
            'id_user' => Auth::user()->id,
            'id_pelanggan'=>$penjualan->id_pelanggan,
            // 'nota'=>$penjualan->nota,
            'bayar'=>$penjualan->bayar,
        ]);
        $pelanggan= Pelanggan::all();
        $barang = Barang::all();
        return view('penjualan.frm_penjualan',['barang' => $barang,'pelanggan' => $pelanggan],compact('penjualan','detail'));
    }

    public function cetaklaporan()
    {
        $penjualan = DB::table("tb_penjualan as a")
        ->join("tb_pelanggan as b","a.id_pelanggan","=","b.id")
        ->get();

        $detail = DB::table("tb_penjualan-detail as a")
        ->join("tb_barang as b","a.id_barang","=","b.id")
        ->get();
        
        return view("penjualan.cetak_laporan",compact('penjualan','detail'));
    }
}
