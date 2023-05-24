<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;



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

Route::post('/clients/{client}/buy', [ClientController::class, 'buy']);
Route::any('/clients/{client}/charge', [UserController::class, 'charge']);
Route::post('/clients/{fromClient}/transfer/{toClient}', [UserController::class, 'transfer']);
Route::get('/report', [AdminController::class, 'report']);