<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleLikeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::get('/', [BlogController::class, 'index']);
Route::get('/blog', [BlogController::class, 'posts'])->name('blog.posts');
Route::get('/blog/{article:slug}', [BlogController::class, 'show'])->name('blog.show');


//ArticleLike 
Route::post('/blog/{article:slug}/likes', [ArticleLikeController::class, 'store'])->name('articles.likes');
Route::delete('/blog/{article:slug}/likes', [ArticleLikeController::class, 'destroy'])->name('articles.likes');

//Articles Controller
Route::resource('blog/articles.comments', ArticleCommentController::class)->only(['store', 'destroy']);

Route::group(['middleware' => 'auth'], function(){
    
    //Dashboard Controller       
    Route::get('dashboard', DashboardController::class)->name('dashboard');
   
    //Super Admin Dashboard
    Route::group(['middleware' => ['role:Super Admin'], 'prefix' => 'admin'], function(){
        //User Management Controller
        Route::resource('users', UserController::class);
    });
    
    //Articles Controller
    Route::resource('articles', ArticleController::class)
            ->except(['show']);

    //Category Controller
    Route::resource('categories', CategoryController::class)
            ->except(['show', 'edit', 'update']);

    //Tag Controller
    Route::resource('tags', TagController::class)
            ->except(['show', 'edit', 'update']);
});
