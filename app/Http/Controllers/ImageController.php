<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public static function getImage()
    {
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('images', $fileName);
            return $fileName;
        }
    }
}
