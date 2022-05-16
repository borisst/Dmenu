<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index()
    {
        $qr = QrCode::format('png')->merge('\public\images\logo.png')->size(250)->generate('This is a qr code');
        return view('qrcode',compact('qr'));
    }
}
