<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Menu;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Category::factory(4)->create();

        User::factory()->has(Company::factory()
            ->has(Menu::factory(2)
                ->hasAttached(Product::factory(5), ['price' => 300, 'user_id' => 1])))->create([
            'name' => 'DAdmin',
            'email' => 'dadmin@dmenu.com',
            'password' => '$2y$10$u0wW68AVOLQ4s11wAGSBCOpo6ypQ52Lv1SG7a1iQII7DW4HQrnYaq', // 12345678
            'role' => 'admin',


        ]);


        User::factory(3)
            ->has(Company::factory()
                ->has(Menu::factory(2)
                    ->hasAttached(Product::factory(5), ['price' => 300, 'user_id' => 1])))
            ->create();
    }
}
