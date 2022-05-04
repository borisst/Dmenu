<?php

use App\Http\Controllers\CompanyController;
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
    Route::get('companies/', 'index')->name('companies-index');
    Route::get('companies/new', 'create')->name('company-create');
    Route::get('companies/{company}', 'show')->name('company-show');
    Route::get('companies/{company}/edit', 'edit')->name('company-edit');
    Route::get('companies/{company}/delete', 'delete')->name('company-delete');
    Route::post('companies/store', 'store')->name('company-store');
    Route::put('companies/{company}', 'update')->name('company-update');
    Route::delete('companies/{company}', 'destroy')->name('company-destroy');

});
