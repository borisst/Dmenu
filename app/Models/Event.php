<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    protected $guarded = [];

    protected $dates = [
        'date'
    ];

    use HasFactory;

    public function scopeOwned($query)
    {
        return $query->where('user_id', Auth::id());

    }

    public function scopePromotionsCount($query)
    {
        return $query->withCount('promotions');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }


}
