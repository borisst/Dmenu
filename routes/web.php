<?php


use App\Http\Controllers\CategoryController;

use App\Http\Controllers\EventController;

use App\Http\Controllers\MenuProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('menus/{menu}/qrcode', [QrCodeController::class, 'viewQrCode'])->name('view-qr-code');
Route::get('companies/{company}/events', [EventController::class, 'welcome'])->name('events.welcome');

Route::controller(EventController::class)->middleware('auth')->group(function () {
    Route::get('events', [EventController::class, 'index'])->name('events');
    Route::get('events/create', [EventController::class, 'create'])->name('events-event.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('events/{event}/promotions', [EventController::class, 'showPromotions'])->name('event.promotions.show');
    Route::put('events/{event}/promotions/{promotion}/add', [EventController::class, 'addPromotion'])->name('event.promotion.add');
    Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::patch('events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::get('events/{event}/delete', [EventController::class, 'destroy'])->name('events.delete');
});

Route::get('companies/{company}/promotions', [PromotionController::class, 'welcome'])->name('promotions.welcome');

Route::controller(PromotionController::class)->middleware('auth')->group(function () {
    Route::get('promotions', [PromotionController::class, 'index'])->name('promotions');
    Route::get('promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('promotions', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('promotions/{promotion}', [PromotionController::class, 'show'])->name('promotions.show');
    Route::get('promotions/{promotion}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
    Route::put('promotions/{promotion}', [PromotionController::class, 'update'])->name('promotions.update');
    Route::get('promotions{promotion}', [PromotionController::class, 'destroy'])->name('promotions.delete');
});


Route::controller(ProductController::class)->middleware('auth')->group(function () {

    Route::get('/{menu}/{category}/products', [ProductController::class, 'welcome'])->name('products.welcome');
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('products/delete/{product}', [ProductController::class, 'destroy'])->name('products.delete');
});

Route::controller(CompanyController::class)->middleware('auth')->group(function () {
    Route::get('companies/', 'index')->name('companies');
    Route::get('companies/create', 'create')->name('companies-company.create');
    Route::get('companies/{company}/edit', 'edit')->name('companies-company.edit');
    Route::post('companies/store', 'store')->name('companies-company.store');
    Route::put('companies/{company}', 'update')->name('companies-company.update');
    Route::get('companies/{company}/delete', 'destroy')->name('companies-company.destroy');
    Route::get('{company}/menus/', 'showMenus')->name('company-menus.show');
    Route::get('{company}/promotions/', 'showPromotions')->name('company-promotions.show');
    Route::get('{company}/events/', 'showEvents')->name('company-events.show');
});

Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies-company.show');


Route::controller(MenuController::class)->middleware('auth')->group(function () {
    Route::get('menus/', 'index')->name('menus');
    Route::get('menus/create', 'create')->name('menus-menu.create');
    Route::get('menus/{company}', 'show')->name('menus-company.show');
    Route::get('menus/{menu}/edit', 'edit')->name('menus-menu.edit');
    Route::get('{menu}/products', 'showProducts')->name('menu-products.show');
    Route::post('menus/store', 'store')->name('menus-menu.store');
    Route::put('menus/{menu}', 'update')->name('menus-menu.update');
    Route::get('menus/{menu}/delete', 'destroy')->name('menus-menu.destroy');
});

Route::get('/{city:slug}/{company:slug}/{menu}', [MenuController::class, 'show'])->name('menus-menu.show');
Route::post('menus/{menu}/attach', [MenuProductController::class, 'attachProducts'])->name('menu-product.attach-products');

Route::get('/{company:slug}/{menu:slug}', [CategoryController::class, 'index'])->name('category.index');


/**
 *This route wasn't functional before. It was intended for listing products by their category.
 *There is a functional and updated route called -> (products.welcome)
 *Route::get('/{company:slug}/{category:slug} ', [CategoryController::class, 'show'])->name('company-category.show');
 */
