<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('employee',EmployeeController::class);
Route::resource('table',TableController::class);
Route::resource('product',ProductController::class);
Route::resource('category',CategoryController::class);

/* php artisan make:controller NombreModeloController -r */ 
/* php artisan make:request NombreModeloRequest */