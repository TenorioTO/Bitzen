<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\AtorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AvaliationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/create', [UserController::class, 'store']);


Route::get('/user/{id}', [UserController::class, 'show']);

Route::put('/user/update/{id}', [UserController::class, 'update']);

Route::delete('/user/exclude/{id}', [UserController::class, 'exclude']);

// Route for films
Route::get('/film/relatorio', [FilmController::class, 'relatorio']);

Route::post('/film/create', [FilmController::class, 'store']);

Route::get('/film', [FilmController::class, 'index']);

Route::get('/film/{id}', [FilmController::class, 'show']);

Route::put('/film/update/{id}', [FilmController::class, 'update']);

Route::delete('/film/delete/{id}', [FilmController::class, 'destroy']);

Route::post('/film/search', [FilmController::class, 'search']);

// Route for Ators
Route::post('/ator/create', [AtorController::class, 'store']);

Route::get('/ator', [AtorController::class, 'index']);

Route::get('/ator/{id}', [AtorController::class, 'show']);

Route::put('/ator/update/{id}', [AtorController::class, 'update']);

Route::delete('/ator/delete/{id}', [AtorController::class, 'destroy']);

// Route for Category
Route::post('/category/create', [CategoryController::class, 'store']);

Route::get('/category', [CategoryController::class, 'index']);

Route::get('/category/{id}', [CategoryController::class, 'show']);

Route::put('/category/update/{id}', [CategoryController::class, 'update']);

Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);

//Route for avaliation
Route::post('/avaliation/create', [AvaliationController::class, 'store']);
Route::group(['middleware' => ['auth:sanctum']], function(){
    


});
