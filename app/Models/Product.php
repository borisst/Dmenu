<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded = [];



    /**
     *
     * Retrieves only active records, use menusWithTrashed() to include soft deleted records
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_product', 'product_id', 'menu_id')
            ->whereNull('menu_product.deleted_at')
            ->withTimestamps()
            ->withPivot(['deleted_at']);
    }

    /**
     *
     * Retrieves ALL records (active and soft deleted ones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menusWithTrashed()
    {
        return $this->belongsToMany(Menu::class, 'menu_product', 'product_id', 'menu_id')
            ->withTimestamps()
            ->withPivot(['deleted_at']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return only user-created products
     * @param $query
     * @return mixed
     */
    public function scopeOwned($query)
    {
        return $query->whereUserId(Auth::id());
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
