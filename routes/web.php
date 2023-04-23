<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Http\Request;
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

// Listings

Route::get('/' , [ListingController::class , 'index']);

Route::get('/listing/{id}' , [ListingController::class , 'show']);

Route::post('/listings' , [ListingController::class , 'store']);

Route::put('/listings/{id}' , [ListingController::class , 'update']);

Route::get('/listings/{id}/edit' , [ListingController::class , 'edit']);

Route::delete('/listings/{listing}', [ListingController::class , 'destroy']);

Route::get('/listings/create' , [ListingController::class , 'create']);

// Users

Route::get('/register' , [UserController::class , 'create']);

Route::get('/login' , [UserController::class , 'login']);

Route::post('/users' , [UserController::class , 'store']);

Route::post('/users/login' , [UserController::class , 'authenticate']);

Route::post('/logout' , [UserController::class , 'logout']);