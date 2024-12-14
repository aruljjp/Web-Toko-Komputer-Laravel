<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
//use App\Models\User;

class HomeCtrl extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data = [
            "tot_plg" => Pelanggan::count(),
            "tot_brg" => Barang::count(),
        ];

        return view("/home",$data);
    }
}
