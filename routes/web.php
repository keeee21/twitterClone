<?php

use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

//ツイートの登録
// Route::post('dashboard',[TweetController::class,'store'])->name('store');


Route::get('tweet.create',[TweetController::class,'create'])->name('tweet.create');
Route::post('tweet.store',[TweetController::class,'store'])->name('tweet.store');




