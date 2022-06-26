<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Event;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Promotion;
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

        $categories = ['coffee', 'beer', 'appetizers', 'alcohol-free', 'fresh juice'];

        foreach ($categories as $category) {
            Category::factory()->create(['name' => $category]);
        }

        $coffees = ['espresso', 'fredo espresso', 'cold espresso', 'macchiato', 'fredo macchiato', 'small macchiatto'];

        foreach ($coffees as $coffee) {
            Product::factory()->create(['name' => $coffee, 'category_id' => 1]);
        }

        $beers = ['Skopsko', 'Zlaten Dab', 'Pilsner', 'Amstel', 'Heineken'];

        foreach ($beers as $beer) {
            Product::factory()->create(['name' => $beer, 'category_id' => 2]);
        }

        $appetizers = ['peanuts', 'walnuts', 'almonds', 'cheese'];

        foreach ($appetizers as $appetizer) {
            Product::factory()->create(['name' => $appetizer, 'category_id' => 3]);
        }

        $cityPubMenus = ['City Pub cafe', 'City Pub special'];

//        foreach ($menus as $menu) {
//            Menu::factory()->create(['name' => $menu]);
//        }

        foreach ($cityPubMenus as $menu) {
            /** @var Menu $menuRecord */
            $menuRecord = Menu::factory()->create(['name' => $menu, 'company_id' => 2]);

            foreach (Product::all()->where('category_id', '1') as $product) {
                $menuRecord->categories()->attach(Category::all()->where('id', '1'), [
                    'product_id' => $product->id,
                    'price' => random_int(1000, 9999)
                ]);
            }

            foreach (Product::all()->where('category_id', '2') as $product) {
                $menuRecord->categories()->attach(Category::all()->where('id', '2'), [
                    'product_id' => $product->id,
                    'price' => random_int(1000, 9999)
                ]);
            }

            foreach (Product::all()->where('category_id', '3') as $product) {
                $menuRecord->categories()->attach(Category::all()->where('id', '3'), [
                    'product_id' => $product->id,
                    'price' => random_int(1000, 9999)
                ]);
            }
        }

        $refreshCafeMenus = ['Refresh cafe', 'Refresh special'];

        foreach ($refreshCafeMenus as $menu) {
            /** @var Menu $menuRecord */
            $menuRecord = Menu::factory()->create(['name' => $menu, 'company_id' => 1]);

            foreach (Product::all()->where('category_id', '1') as $product) {
                $menuRecord->categories()->attach(Category::all()->where('id', '1'), [
                    'product_id' => $product->id,
                    'price' => random_int(1000, 9999)
                ]);
            }

            foreach (Product::all()->where('category_id', '2') as $product) {
                $menuRecord->categories()->attach(Category::all()->where('id', '2'), [
                    'product_id' => $product->id,
                    'price' => random_int(1000, 9999)
                ]);
            }

            foreach (Product::all()->where('category_id', '3') as $product) {
                $menuRecord->categories()->attach(Category::all()->where('id', '3'), [
                    'product_id' => $product->id,
                    'price' => random_int(1000, 9999)
                ]);
            }
        }

        $events = ['Hotline', 'Nokaut'];

        foreach ($events as $event) {
            Event::factory()->create(['name' => $event]);
        }

        $promotions = ['Cocktail Party', 'Beer Party'];

        foreach ($promotions as $promotion) {
            Promotion::factory()->create(['name' => $promotion]);
        }

    }


}
