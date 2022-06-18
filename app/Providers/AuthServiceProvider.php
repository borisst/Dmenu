<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Event;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Promotion;
use App\Policies\CompanyPolicy;
use App\Policies\EventPolicy;
use App\Policies\MenuPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PromotionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        Company::class => CompanyPolicy::class,
        Menu::class => MenuPolicy::class,
        Event::class => EventPolicy::class,
        Promotion::class => PromotionPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
