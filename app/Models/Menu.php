<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Menu extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'menus';


    /**
     * The attributes that are not mass assignable.
     * @var array<int, string>
     */
    protected $guarded = [];




    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return only user-owned menus.
     * @param $query
     * @return mixed
     */
    public function scopeOwned($query)
    {
        return $query->whereRelation('company', 'owner', Auth::id()); //checks if the menu's company is owned by auth user
    }

    /**
     * Filter by company
     * @param $query
     * @param $company
     * @return mixed
     */
    public function scopeCompany($query, $company)
    {
        return $query->where('company_id', $company);

    }

    public function scopeProductsCount($query)
    {
        return $query->withCount('products');
    }

    /**
     *
     * Excludes soft deleted records, use productsWithTrashed() to include soft deleted records
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'menu_product', 'menu_id', 'product_id')
            ->whereNull('menu_product.deleted_at')
            ->withTimestamps()
            ->with('category:id,name')
            ->withPivot(['deleted_at', 'user_id']);

    }

    /**
     *
     * Retrieves ALL records (active and soft deleted ones)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productsWithTrashed()
    {
        return $this->belongsToMany(Product::class, 'menu_product', 'menu_id', 'product_id')
            ->withTimestamps()
            ->withPivot(['deleted_at', 'name']);

    }

    public function company()
    {
        return $this->belongsTo(Company::class)->with('city');
    }

}
