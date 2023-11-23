<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Models\Chirp;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});




Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');
    Route::post('/chirp/store', [ChirpController::class, 'store'])->name('chirp.store');
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])->name('chirps.edit');
    Route::put('/chirps/{chirp}/update', [ChirpController::class, 'update'])->name('chirp.update');
    Route::delete('/chirps/{chirp}/destroy', [ChirpController::class, 'destroy'])->name('chirps.destroy');

    /* X TWEETS */
    Route::get('/tweets', [TweetController::class, 'index'])->name('tweet.index');
    Route::post('/tweets/store', [TweetController::class, 'store'])->name('tweet.store');
    Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->name('tweet.edit');
    Route::put('/tweets/{tweet}/update', [TweetController::class, 'update'])->name('tweet.update');
    Route::delete('/tweets/{tweet}/delete', [TweetController::class, 'destroy'])->name('tweet.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
