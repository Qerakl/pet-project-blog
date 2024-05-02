<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)->group(function (){
    Route::post('/login','login')->name('login');
    Route::post('/register','register')->name('register');
    Route::post('/logout','logout')->name('logout');
});
Route::controller(CommentController::class)->group(function (){
    Route::post('/comments/store/{id}','add_comment')->name('comments/store');
    
    
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::resource('articles', ArticleController::class);

Route::middleware('auth:sanctum')->get('/', [ArticleController::class, 'index']);



