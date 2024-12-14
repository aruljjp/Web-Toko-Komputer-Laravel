<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Rekanan;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class PembelianCtrl extends Controller
{
    public function index()
    {
        $pembelian= DB::table('tb_pembelian as a')->leftjoin('tb_rekanan as b','a.id_rekanan','b.id')->selectraw('a.*,b.nama as nama_rekanan')->paginate(10);
        return view('pembelian.laporan',compact('pembelian'));
    }

    public function create()
    {
        $pembelian= DB::table('tbl_tampung')->where('id_user',Auth::user()->id)->first();
        $rekanan= Rekanan::all();
        $barang = Barang::all();
        return view('pembelian.frm_pembelian',['barang' => $barang,'rekanan' => $rekanan],compact('pembelian'));
    }

    public function store(Request $req)
    {

        DB::table('tb_pembelian')->insert([
            'id_rekanan'=>$req->id_rekanan,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            
        ]);
        $q = DB::table('tb_pembelian')->orderBy('id_pembelian','desc')->first();
        $id = $q->id_pembelian;
        $detail = DB::table('tbl_tampung_detail')->where('id_user',Auth::user()->id)->get();
        foreach($detail as $data){
            DB::table('tb_pembelian-detail')->insert([
                'id_pembelian'=>$id,
                'id_barang'=>$data->id_barang,
                'harga'=>$data->harga,
                'qty'=>$data->qty,
                'total'=>$data->total,
            ]);

            $barang = Barang::find($data->id_barang);
            $barang->stok += $data->qty;
            $barang->save();
        }
        DB::table('tbl_tampung_detail')->where('id_user',Auth::user()->id)->delete();

        return redirect('pembelian/cetak/'.$id.'') -> with('pesan','Tambah Data Tersimpan');
    }

    function get(Request $req)
    {
        $barang = DB::table('tbl_tampung_detail')->where('id',$req->id)->first();
        echo json_encode($barang);
    }

    public function update(Request $request)
    {
        DB::table('tb_pembelian-detail')->where('id','=',$request->id)->update([
            'id_barang'=>$request->id_barang,
            'harga'=>$request->harga,
            'qty'=>$request->qty,
            'total'=>$request->total,
        ]);
        DB::table('tb_pembelian')->where('')->update([
            'id_rekanan'=>$request->id_rekanan,
            'nota'=>$request->nota,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
        ]);
        return redirect('pembelian/laporan')->with('pesan','Edit Data Tersimpan');
    }

    public function delete($id)
    {
        DB::table('tb_pembelian-detail')->where('id_pembelian', '=', $id)->delete();
        DB::table('tb_pembelian')->where('id_pembelian', '=', $id)->delete();
        return redirect('pembelian/laporan')->with('delete','Data Laporan Terhapus');
    }

    public function simpantampung(Request $req)
    {
        $tot = $req->harga*$req->qty;
        
        if($req->id_tampung != ""){
            DB::table('tbl_tampung_detail')->where('id',$req->id_tampung)->update([
                'id_user' => Auth::user()->id,
                'id_barang'=>$req->id_barang,
                'harga'=>$req->harga,
                'qty'=>$req->qty,
                'total'=>$tot,
            ]);

        }else{
            DB::table('tbl_tampung_detail')->insert([
                'id_user' => Auth::user()->id,
                'id_barang'=>$req->id_barang,
                'harga'=>$req->harga,
                'qty'=>$req->qty,
                'total'=>$tot,
            ]);
        }

        return redirect('pembelian/frm_pembelian')->with('success','Tambah Barang Tersimpan');
    }

    public function deletetampung($id)
    {
        DB::table('tbl_tampung_detail')->where('id','=',$id)->delete();

        return redirect('pembelian/frm_pembelian')->with('error','Data Barang Terhapus');
    }

    public function shownota()
    {
        return view('pembelian.nota');
    }
    function cetaknota($id){

        $pembelian = DB::table("tb_pembelian as a")
        ->join("tb_rekanan as b","a.id_rekanan","=","b.id")
        ->where("a.id_pembelian",$id)
        ->get();

        $detail = DB::table("tb_pembelian-detail as a")
        ->join("tb_barang as b","a.id_barang","=","b.id")
        ->where("a.id_pembelian",$id)
        ->get();
        
        return view("pembelian.nota",compact('pembelian','detail'));
    }
    public function edit($idcari)
    {

        $pembelian=DB::table('tb_pembelian')->where('id_pembelian','=',$idcari)->first();
        $detail=DB::table('tb_pembelian-detail')->where('id_pembelian','=',$idcari)->get();
        foreach($detail as $a){
            $tot = $a->harga*$a->qty;
            DB::table('tbl_tampung_detail')->insert([
                'id_user' => Auth::user()->id,
                'id_barang'=>$a->id_barang,
                'harga'=>$a->harga,
                'qty'=>$a->qty,
                'total'=>$tot,
            ]);
        }
        DB::table('tbl_tampung')->insert([
            'id_user' => Auth::user()->id,
            'id_rekanan'=>$pembelian->id_rekanan,
            'alamat'=>$pembelian->alamat,
            'telp'=>$pembelian->telp,
        ]);
        $rekanan= Rekanan::all();
        $barang = Barang::all();
        return view('pembelian.frm_pembelian',['barang' => $barang,'rekanan' => $rekanan],compact('pembelian','detail'));
    }

    public function showcetak()
    {
        return view('pembelian.cetak_laporan');
    }

    public function cetaklaporan()
    {
        $pembelian = DB::table("tb_pembelian as a")
        ->join("tb_rekanan as b","a.id_rekanan","=","b.id")
        ->get();

        $detail = DB::table("tb_pembelian-detail as a")
        ->join("tb_barang as b","a.id_barang","=","b.id")
        ->get();
        
        return view("pembelian.cetak_laporan",compact('pembelian','detail'));
    }
}
