<?php



use App\Http\Controllers\CategoryController;

use App\Http\Controllers\EventController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('menus/{menu}/qrcode', [QrCodeController::class, 'viewQrCode']);
Route::get('companies/{company}/events',[EventController::class,'welcome'])->name('events.welcome');

Route::controller(EventController::class)->middleware('auth')->group(function () {
    Route::get('events', [EventController::class,'index'])->name('events');
    Route::get('events/create',[EventController::class,'create'])->name('events.create');
    Route::post('events',[EventController::class,'store'])->name('events.store');
    Route::get('events/{event}',[EventController::class,'show'])->name('events.show');
    Route::get('events/{event}/edit',[EventController::class,'edit'])->name('events.edit');
    Route::patch('events/{event}',[EventController::class,'update'])->name('events.update');
    Route::delete('events/{event}',[EventController::class,'destroy'])->name('events.delete');
});

Route::controller(ProductController::class)->middleware('auth')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.delete');
});

Route::controller(CompanyController::class)->middleware('auth')->group(function () {
    Route::get('companies/', 'index')->name('companies');
    Route::get('companies/create', 'create')->name('companies.create');
    Route::get('companies/{company}/edit', 'edit')->name('companies-company.edit');
    Route::get('companies/{company}/delete', 'delete')->name('companies-company.delete');
    Route::post('companies/store', 'store')->name('companies.store');
    Route::put('companies/{company}', 'update')->name('companies-company.update');
    Route::delete('companies/{company}', 'destroy')->name('companies-company.destroy');

});

Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies-company.show');


Route::controller(MenuController::class)->middleware('auth')->group(function () {
    Route::get('menus/', 'index')->name('menus');
    Route::get('menus/create', 'create')->name('menus-menu.create');
    Route::get('menus/{company}', 'show')->name('menus-company.show');
    Route::get('menus/{menu}/edit', 'edit')->name('menus-menu.edit');
    Route::get('menus/{menu}/delete', 'delete')->name('menus-menu.delete');
    Route::post('menus/store', 'store')->name('menus-menu.store');
    Route::put('menus/{menu}', 'update')->name('menus-menu.update');
    Route::delete('menus/{menu}', 'destroy')->name('menus-menu.destroy');
});

Route::get('/{city:slug}/{company:slug}/{menu}', [MenuController::class, 'show'])->name('menus-menu.show');

Route::get('/{company:slug}/{menu:slug}', [CategoryController::class, 'index'])->name('category.index');
Route::get('/{company:slug}/{category:slug}', [CategoryController::class, 'show'])->name('company-category.show');
