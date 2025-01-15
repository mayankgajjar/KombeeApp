<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/AddUser', [UserController::class, 'add'])->name('AddUser');
Route::get('/EditUser/{id}', [UserController::class, 'edit'])->name('EditUser');
Route::get('exportPDF', [UserController::class, 'exportPdf'])->name('exportPDF');
Route::get('exportCsv', [UserController::class, 'exportCsv'])->name('exportCsv');
Route::get('exportExcel', [UserController::class, 'exportExcel'])->name('exportExcel');

Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
Route::get('/AddSupplier', [SupplierController::class, 'add'])->name('AddSupplier');
Route::get('/EditSupplier/{id}', [SupplierController::class, 'edit'])->name('EditSupplier');

Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
Route::get('/AddCustomer', [CustomerController::class, 'add'])->name('AddCustomer');
Route::get('/EditCustomer/{id}', [CustomerController::class, 'edit'])->name('EditCustomer');

Route::get('/role', [RoleController::class, 'index'])->name('role');
Route::get('/AddRole', [RoleController::class, 'add'])->name('AddRole');
Route::get('/EditRole/{id}', [RoleController::class, 'edit'])->name('EditRole');
Route::get('/RolePermission/{id}', [RoleController::class, 'permission'])->name('RolePermission');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');