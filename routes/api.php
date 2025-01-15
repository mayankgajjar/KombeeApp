<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\GeneralController;


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

Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');

Route::middleware('auth:api')->get('/user-data', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group( function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('roles', RolesController::class);

        Route::get('getAllPermission', [RolesController::class, 'getAllPermission'])->name('getAllPermission');
        Route::post('SavePermission', [RolesController::class, 'SavePermission'])->name('SavePermission');
        Route::get('getRolePermission/{id}', [RolesController::class, 'getRolePermission'])->name('getRolePermission');

        Route::resource('users', UserController::class);
        Route::get('DeleteImage/{id}', [UserController::class, 'DeleteImage'])->name('DeleteImage');
        Route::post('UpdateUser/{id}', [UserController::class, 'update'])->name('UpdateUser');

        Route::resource('supplier', SupplierController::class);
        Route::resource('customer', CustomerController::class);

        Route::get('getStateList', [GeneralController::class, 'getStateList'])->name('getStateList');
        Route::get('getCityList/{id}', [GeneralController::class, 'getCityList'])->name('getCityList');

        Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
        
    });
});


