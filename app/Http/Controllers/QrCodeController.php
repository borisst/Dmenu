<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function viewQrCode(Menu $menu)
    {
        $qrCode = $menu->qrcode;
        $generateQr = QrCode::format('png')->generate('/images/qr-code/img-');
        return view('qrcode', compact('qrCode','generateQr'));
    }
}
