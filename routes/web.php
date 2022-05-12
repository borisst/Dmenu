<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::controller(CompanyController::class)->middleware('auth')->group(function () {
    Route::get('companies/', 'index')->name('companies');
    Route::get('companies/create', 'create')->name('companies.create');
    Route::get('companies/{company}', 'show')->name('companies-company');
    Route::get('companies/{company}/edit', 'edit')->name('companies-company.edit');
    Route::get('companies/{company}/delete', 'delete')->name('companies-company.delete');
    Route::post('companies/store', 'store')->name('companies.store');
    Route::put('companies/{company}', 'update')->name('companies-company.update');
    Route::delete('companies/{company}', 'destroy')->name('companies-company.destroy');

});

Route::controller(MenuController::class)->middleware('auth')->group(function () {
    Route::get('menus/', 'index')->name('menus');
    Route::get('menus/{company}/create', 'create')->name('menus-company.create');
    Route::get('menus/{company}', 'show')->name('menus-company.show');
    Route::get('menus/{menu}/edit', 'show')->name('menus-menu.edit');
    Route::get('menus/{menu}/delete', 'delete')->name('menus-menu.delete');
    Route::post('menus/store', 'delete')->name('menus.store');
    Route::put('menus/{menu}', 'update')->name('menus-menu.update');
    Route::delete('menus/{menu}', 'destroy')->name('menus-menu.destroy');
});
