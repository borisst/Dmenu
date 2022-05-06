<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('products', [ProductController::class, 'index']);
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::patch('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.delete');


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

