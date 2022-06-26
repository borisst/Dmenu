<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function viewQrCode(Menu $menu)
    {
        $qrCode = $menu->qrcode;
        $logo = $menu->logo;
        $generateQr = QrCode::format('png')->merge('\public\logo\\'.$logo)->generate(request()->url());
        return view('qrcode', compact('qrCode', 'generateQr'));
    }

    public function storeQrCodeLogo()
    {
        if (request()->has('logo')) {
            $file = request()->file('logo');
            $fileName = time().'.png';
            $file->move('logo', $fileName);
            return $fileName;
        }
    }

    public function storeQrCode()
    {
        $image = QrCode::format('png')
            ->size(200)
            ->errorCorrection('H')
            ->generate(request()->url());
        $path = '/images/qr-code/'.time().'.png';
        $output_file = time().'.png';
        Storage::disk('public')->put($path, $image);
        return $output_file;
    }
}
