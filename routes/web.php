<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/products/{id}/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');


Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/categories', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/popular-categories', [CategoryController::class, 'popularShow'])->name('сategories.popular');

Route::post('/favorites/toggle', [ProductController::class, 'toggleFavorites'])->name('favorites.toggle');




