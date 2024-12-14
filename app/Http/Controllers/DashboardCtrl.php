<?php

namespace App\Http\Controllers;

use App\Models\Rekanan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data = [
            "tot_user" => User::count(),
            "tot_rekan" => Rekanan::count(),
        ];

        return view("/dashboard",$data);
    }
}
