<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
