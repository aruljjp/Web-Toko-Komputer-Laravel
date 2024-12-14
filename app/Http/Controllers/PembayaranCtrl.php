<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranCtrl extends Controller
{
    public function pembayaran()
    {
        return view('/pembayaran/frm_pembayaran');
    }
}
