<?php

use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/dashboard',[TweetController::class,'getDashboard'])->name('dashboard');

Route::get('tweet/create',[TweetController::class,'create'])->name('tweet.create');
Route::post('tweet/store',[TweetController::class,'store'])->name('tweet.store');
Route::get('tweet/show/{id}',[TweetController::class,'show'])->name('tweet.show');


Route::get('profile/create',[ProfileController::class,'create'])->name('profile.create');
Route::get('profile/store',[ProfileController::class,'storeOrUpdate'])->name('profile.store');
Route::get('profile/show/{id}',[ProfileController::class,'show'])->name('profile.show');
Route::post('profile/store',[ProfileController::class,'store'])->name('profile.store');
