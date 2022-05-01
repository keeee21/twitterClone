<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Follower;

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

Route::group(['middleware' => 'auth'], function(){
    // Route::get('/dashboard',[TweetController::class,'getDashboard'])->name('dashboard');
    Route::get('tweet/create',[TweetController::class,'create'])->name('tweet.create');
    Route::post('tweet/store',[TweetController::class,'store'])->name('tweet.store');
    Route::post('tweet/destroy/{id}',[TweetController::class,'destroy'])->name('tweet.destroy');
    Route::get('profile/index',[ProfileController::class,'index'])->name('profile.index');
    Route::get('profile/store',[ProfileController::class,'storeOrUpdate'])->name('profile.store');
    Route::post('profile/store',[ProfileController::class,'store'])->name('profile.store');
    Route::get('profile/edit',[ProfileController::class,'edit'])->name('profile.edit');
    Route::post('profile/update',[ProfileController::class,'update'])->name('profile.update');
    Route::post('profile/destroy',[ProfileController::class,'destroy'])->name('profile.destroy');
    Route::post('users/follow/{user}',[FollowerController::class,'follow'])->name('follow');
    Route::post('users/unfollow/{user}',[FollowerController::class,'unfollow'])->name('unfollow');
    Route::post('users/favorite/{tweet}',[FavoriteController::class,'favorite'])->name('favorite');
    Route::post('users/unfavorite/{tweet}',[FavoriteController::class,'unFavorite'])->name('unfavorite');
});

//ログインしなくても使えるものを外に出す
Route::get('/dashboard',[TweetController::class,'getDashboard'])->name('dashboard');
Route::get('user/index',[UserController::class,'index'])->name('user.index');
Route::get('follow',[FollowerController::class,'showFollowingUser'])->name('follow.show');
Route::get('follower',[FollowerController::class,'showFollowerUser'])->name('follower.show');
Route::get('favorite.tweets',[FavoriteController::class,'favoriteTweets'])->name('favorite.tweets');
Route::get('favorite/users/{id}',[FavoriteController::class,'favoriteUsers'])->name('favorite.users');
Route::get('profile/show/{id}',[ProfileController::class,'show'])->name('profile.show');
Route::get('tweet/{id}',[TweetController::class,'show'])->name('tweet.show');

require __DIR__.'/auth.php';