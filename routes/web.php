<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoomController;
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

Route::resource('/category',CategoryController::class)->names('categories');
Route::get('/room-facility-delete',[RoomController::class,'roomFacilityDelete'])->name('rooms.facility.delete');
Route::resource('/rooms',RoomController::class)->names('rooms');