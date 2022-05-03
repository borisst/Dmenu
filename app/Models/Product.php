<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'menus', 'product_id', 'company_id')->withTimestamps();
    }
}
