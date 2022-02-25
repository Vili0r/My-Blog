<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleLikeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
    
    //Super Admin Dashboard
    Route::group(['middleware' => ['role:Super Admin'], 'prefix' => 'admin'], function(){
        
        //User Management Controller
        Route::resource('users', UserController::class);
    });
    
    //Articles Controller
    Route::resource('articles', ArticleController::class);

    //Category Controller
    Route::resource('categories', CategoryController::class)
            ->except(['show', 'edit', 'update']);

    //Tag Controller
    Route::resource('tags', TagController::class)
            ->except(['show', 'edit', 'update']);

    //Blog Controller
    Route::resource('blogs', BlogController::class)->only(['index']);

    //ArticleLike 
    Route::post('articles/{article}/likes', [ArticleLikeController::class, 'store'])->name('articles.likes');
    Route::delete('articles/{article}/likes', [ArticleLikeController::class, 'destroy'])->name('articles.likes');

    //Articles Controller
    Route::resource('articles.comments', ArticleCommentController::class)->only(['store', 'destroy']);
});
