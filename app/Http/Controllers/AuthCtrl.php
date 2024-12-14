<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function form_login()
    {
        return view('auth/login');
    }
    public function process_login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = DB::table('users')->where('name',$request->name)->first();

        if (auth()->attempt($credentials)) {
            if(Auth::user()->level=='admin'){
                return redirect('/dashboard')->with('pesan','Login Sebagai Admin Success');
            }elseif(Auth::user()->level=='pegawai'){
                return redirect('/home')->with('pesan','Login Sebagai Pegawai Success');
            }else{
                return redirect('/homepage');
            }
        }else{
            return redirect()->back()->with('error','Login gagal,password salah');
        }

    }
    public function show_signup_form()
    {
        return view('register');
    }
    public function process_signup(Request $request)
    {   
        $rules=[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:5',
        ];
        $messages=[
            'name.required'=>'nama wajib diisi',
            'email.required'=>'email wajib diisi',
            'password.required'=>'password tidak boleh kosong',
        ];
        $this->validate($request,$rules,$messages);

        if($request->file('foto') == null){
            $user = DB::table('users')->insert([
                'name' => trim($request->input('name')),
                'email' => strtolower($request->input('email')),
                'password' => bcrypt($request->input('password')),
            ]); 
        }else{
            $foto=$request->file('foto');
            $nm_foto=$foto->getClientOriginalName();
            $foto->move(public_path()."/uploads/",$nm_foto);

            $user = DB::table('users')->insert([
                'name' => trim($request->input('name')),
                'email' => strtolower($request->input('email')),
                'password' => bcrypt($request->input('password')),
                'foto' => $nm_foto,
            ]);  
        } 
        return redirect()->route('login')->with('success','Sign Up Success');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('error','Anda sedang logout');
    }
    
}
