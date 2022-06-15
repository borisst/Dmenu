<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Menu;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'DAdmin',
            'email' => 'dadmin@dmenu.com',
            'password' => '$2y$10$u0wW68AVOLQ4s11wAGSBCOpo6ypQ52Lv1SG7a1iQII7DW4HQrnYaq', // 12345678
            'role' => 'admin',
        ]);

        $cities = ['Berovo', 'Pehchevo'];

        foreach ($cities as $city) {
            City::factory()->create(['name' => $city]);
        }

        $companies = ['Refresh', 'City Pub'];

        foreach ($companies as $company) {
            Company::factory()->create(['name' => $company]);
        }

        $menus = ['City Pub cafe', 'City Pub special', 'Refresh cafe', 'Refresh special'];

        foreach ($menus as $menu) {
            Menu::factory()->create(['name' => $menu]);
        }

        $categories = ['coffee', 'beer', 'appetizers', 'alcohol-free', 'fresh juice'];

        foreach ($categories as $category) {
            Category::factory()->create(['name' => $category]);
        }

        $coffees = ['espresso', 'fredo espresso', 'cold espresso', 'macchiato', 'fredo macchiato', 'small macchiatto'];

        foreach ($coffees as $coffee) {
            Product::factory()->create(['name' => $coffee]);
        }

        $beers = ['Skopsko', 'Zlaten Dab', 'Pilsner', 'Amstel', 'Heineken'];

        foreach ($beers as $beer) {
            Product::factory()->create(['name' => $beer]);

        }

        $appetizers = ['peanuts', 'walnuts', 'almonds', 'cheese'];

        foreach ($appetizers as $appetizer) {
            Product::factory()->create(['name' => $appetizer]);

        }


    }
}
