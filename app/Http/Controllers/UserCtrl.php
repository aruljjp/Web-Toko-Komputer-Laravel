<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class UserCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = DB::table('users')->orderBy('last_seen', 'desc')->paginate(5);
        return view('user/frm_user',compact('user'));
    }

    public function edit($idcari)
    {
        $user=User::find($idcari);
        return view('user/edit_user',compact('user'));
    }

    public function update(Request $request,User $user)
    {
        if($request->file('foto')!= ""){
            $foto=$request->file('foto');
            $nama_foto=$foto->getClientOriginalName();
            $foto->move(public_path()."/uploads/",$nama_foto);
        }else{
            $nama_foto= $request->oldfoto;
        }
        
        // var_dump($request->all());exit;

        User::where('id',$user->id)
        ->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'level'=>$request->level,
            'foto'=>$nama_foto,
        ]);
        return redirect('/user/frm_user')->with('success','Edit Data Tersimpan');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('user/frm_user')->with('delete','Data Terhapus');
    }

    public function create()
    {
        return view('user/create_user');
    }

    public function store(Request $request)
    {
        User::create($request->all());
        return redirect('user/frm_user') -> with('pesan','Tambah User Tersimpan');
    }
    
    public function show_password()
    {
        return view('user/password');
    }

    public function ubah_password(Request $request)
    {
        $hash = Hash::make($request->newpassword);
        $user = DB::table('users')->where('id',Auth::user()->id)->update([
            'password'=> $hash
        ]);
        return redirect()->back()->with('pesan','password success diganti');

    }

    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)){
                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            }else{
                echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            }
        }
    }
}
