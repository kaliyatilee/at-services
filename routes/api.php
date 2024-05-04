<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\DSTV\DSTVPackageController;
use App\Http\Controllers\DSTV\DSTVPaymentController;
use App\Http\Controllers\DSTV\DSTVTransactionController;
use App\Http\Controllers\Insurance\InsuranceBrokerController;
use App\Http\Controllers\Insurance\InsurancePaymentController;
use App\Http\Controllers\Loan\LoanDisbursedController;
use App\Http\Controllers\Loan\LoanPaymentController;
use App\Http\Controllers\UsersController;
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
