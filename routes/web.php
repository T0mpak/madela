<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add', [BasketController::class, 'store'])->name('basket.add');
Route::post('/basket/remove', [BasketController::class, 'destroy'])->name('basket.remove');
Route::get('/basket/get-if-already-in', [BasketController::class, 'get_already'])->name('basket.already');
Route::post('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');

Route::get('/comparison', [ComparisonController::class, 'index'])->name('comparison');
Route::post('/comparison/add', [ComparisonController::class, 'store'])->name('comparison.add');

Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');

Route::get('/promotions', [PromotionsController::class, 'index'])->name('promotions.index');
Route::get('/promotions/create', [PromotionsController::class, 'create'])->name('promotions.create');
Route::post('/promotions/store', [PromotionsController::class, 'store'])->name('promotions.store');
Route::get('/promotions/{promotion}', [PromotionsController::class, 'show'])->name('promotions.show');

Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
Route::post('/orders/save', [OrdersController::class, 'store'])->name('orders.store');
Route::post('/orders/discount', [OrdersController::class, 'get_discount_for_promocode'])->name('orders.discount');

Route::get('/users/{user:id}', [UserController::class, 'index'])->name('users.index');
Route::post('/users/cancel', [UserController::class, 'cancel'])->name('users.cancel');
Route::post('/users/finish', [UserController::class, 'finish'])->name('users.finish');

Route::resource('categories', CategoryController::class);

Route::resource('products', ProductController::class);
Route::get('/products_filtered', [FilterController::class, 'filter'])->name('filter.products');

Route::resource('manufacturers', ManufacturerController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/moderator', [ModeratorController::class, 'index'])->name('moderator.index');
Route::get('/moderator/unapproved', [ModeratorController::class, 'unapproved'])->name('moderator.unapproved');
Route::post('/moderator/approve', [ModeratorController::class, 'approve'])->name('moderator.approve');
Route::get('/moderator/unfinished', [ModeratorController::class, 'unfinished'])->name('moderator.unfinished');
Route::post('/moderator/finish', [ModeratorController::class, 'finish'])->name('moderator.finish');

Route::get('/mail-orders/made', [MailController::class, 'send_mail_order_made'])->name('main.orders.made');

Route::get('/search', [SearchController::class, 'index'])->name('search');

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
