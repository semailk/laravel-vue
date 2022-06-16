<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('add/employee', [MainController::class, 'addEmployee']);
Route::post('add-booking', [MainController::class, 'booking']);
Route::post('add-client', [MainController::class, 'addClient']);
Route::post('add-rent', [MainController::class, 'addRent']);
Route::get('get-all-tables', [MainController::class, 'getAllTables']);
Route::get('/home', [MainController::class, 'index']);
Route::get('close-booking/{id}',[MainController::class, 'closeBooking']);
Route::get('edit/booking/{id}',[MainController::class, 'editBooking']);
Route::delete('booking/delete/{id}',[MainController::class, 'deleteBooking']);
Route::patch('update/booking/{id}',[MainController::class, 'updateBooking']);
