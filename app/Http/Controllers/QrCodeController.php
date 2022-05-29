<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index()
    {
        $qr = QrCode::format('png')->merge('\public\images\logo.png')->size(250)->generate('http://dmenu.test/menus');
        return view('qrcode',compact('qr'));
    }
}
