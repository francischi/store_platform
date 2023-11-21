<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Customer\CustomerController;
use App\Http\Merchant\MerchantController;

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

Route::post('/customer', [CustomerController::class, 'create']);
Route::get('/customers', [CustomerController::class, 'getAll']);

Route::post('/merchant', [MerchantController::class, 'create']);
