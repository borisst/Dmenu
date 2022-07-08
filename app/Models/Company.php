<?php

namespace App\Models;

use App\Mail\NoEvents;
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

    public function events(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function promotions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Promotion::class);
    }

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function menus(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
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

    public function sendEventReminder()
    {
        if ($this->events()->doesntExist()) {
            Mail::to($this->owner->email)->send(new NoEvents());
        }
    }
}
