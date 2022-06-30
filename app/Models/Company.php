<?php

namespace App\Models;

use App\Mail\NoPromotions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        return $this->belongsTo(User::class, 'owner_id');
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
        return $query->whereOwnerId(Auth::id());
    }

    public function sendPromotionReminder()
    {
        if ($this->promotions()->doesntExist()) {
            Mail::to($this->owner->email)->send(new NoPromotions());
        }
    }
}
