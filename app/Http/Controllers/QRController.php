<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRController extends Controller
{
    public function showQRForm()
    {
        return view('readQR');
    }
}
