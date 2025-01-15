<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomePageController::class,"index"])->name('home_page');
Route::get('/about',    [HomePageController::class,"about"])->name('about');
Route::get('/contact',  [ContactController::class,"index"])->name('contact');
Route::get('/post',     [App\Http\Controllers\PostController::class,"index"])->name('post');
Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/{post:slug}',[App\Http\Controllers\PostController::class,"get"])->name('post.open');


Route::middleware(['auth'])->group(function () {

    Route::middleware(['can:create,App\Models\Post'])->group(function () {
        Route::get('/post/form', [PostController::class,"create"])->name('post.create');
        Route::post('/post', [PostController::class,"store"])->name('post.store');
    });    

    Route::middleware(['can:viewAny,App\Models\Post'])->group(function () {
        Route::get('/post/list', [PostController::class,"list"])->name('post.list');
        Route::get('/post/{post}', [PostController::class,"edit"])->name('post.edit');
    });

    Route::middleware(['can:update,post',
                                   'can:delete,post',])->group(function () {
        Route::put("/post/{post}", [PostController::class,"update"])->name('post.update');
        Route::delete('/post/{post}', [PostController::class,"destroy"])->name('post.destroy');
    });

    Route::middleware(['can:admin-access'])->group(function () {
        Route::get('/user/list', [UserController::class,"list"])->name('user.list');
        Route::get('/user/form', [UserController::class,"create"])->name('user.create');
        Route::post('/user', [UserController::class,"store"])->name('user.store');
        Route::get('/user/{user}', [UserController::class,"edit"])->name('user.edit');
        Route::put("/user/{user}", [UserController::class,"update"])->name('user.update');
        Route::delete('/user/{user}', [UserController::class,"destroy"])->name('user.destroy');


        Route::get('/category/list', [CategoryController::class,"list"])->name('category.list');
        Route::get('/category/form', [CategoryController::class,"create"])->name('category.create');
        Route::post('/category', [CategoryController::class,"store"])->name('category.store');
        Route::get('/category/{category}', [CategoryController::class,"edit"])->name('category.edit');
        Route::put("/category/{category}", [CategoryController::class,"update"])->name('category.update');
        Route::delete('/category/{category}', [CategoryController::class,"destroy"])->name('category.destroy');
        
        Route::get('/category/desvincular/{category_post}', [CategoryController::class,"desvincular"])->name('category.desvincular');
    });
});
