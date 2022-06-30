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


    public function scopePromotionsCount($query)
    {
        return $query->withCount('promotions');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
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
