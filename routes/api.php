<?php

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/book_by_author/{id}', function (string $id) {
    return BookResource::collection(
        Book::with('author')->whereHas('author',function($query) use(&$id){
            $query->where('id','=',$id);
        })->orderBy('book_name')->get()
    );
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
