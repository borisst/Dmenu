<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function getImage()
    {
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('images', $fileName);
            return $fileName;
        }
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'menus', 'product_id', 'company_id')->withTimestamps();
    }
}
