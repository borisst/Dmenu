<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     * @var array<int, string>
     */
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }


    /**
     * Return only user-created companies
     * @param $query
     * @return mixed
     */
    public function scopeOwned($query)
    {
        return $query->whereOwner(Auth::id());

    }
}
