<?php

namespace Database\Seeders;

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
        $user = User::factory(2)
             ->has(Company::factory()->count(1))
             ->create();

         Product::factory()->has(Company::factory());

         Menu::factory(2)->hasAttached(Product::factory()->count(4), ['price' => 300, 'user_id' => 1])->create();
    }
}
