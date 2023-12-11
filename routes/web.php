<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class,'show']);
Route::get('/top-ten', [HomeController::class,'showAuthors']);
Route::get('/rate', [HomeController::class,'showRatings']);
Route::post('/store-rating',[HomeController::class,'storeRating']);
