<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('users.index');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('/users/add', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::get('/users/detail/{user}',[App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::post('/users',[App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::put('/users/{user}',[App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}',[App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');


Route::get('/depts', [App\Http\Controllers\DepartmentController::class, 'index'])->name('depts.index');
Route::get('/depts/detail/{department}',[App\Http\Controllers\DepartmentController::class, 'show'])->name('depts.show');
Route::put('/depts/{department}',[App\Http\Controllers\DepartmentController::class, 'update'])->name('depts.update');
Route::get('/depts/add', [App\Http\Controllers\DepartmentController::class, 'create'])->name('depts.create');
Route::post('/depts',[App\Http\Controllers\DepartmentController::class, 'store'])->name('depts.store');
Route::delete('/depts/{department}',[App\Http\Controllers\DepartmentController::class, 'delete'])->name('depts.delete');

Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])->name('upload');
Route::get('/users/getlist', [App\Http\Controllers\UserController::class, 'usersList'])->name('users.list');
});


