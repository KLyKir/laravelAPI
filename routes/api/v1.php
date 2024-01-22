<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/user/{id}', [\App\Http\Controllers\Api\V1\UserController::class, 'getUser'])->name('user');
Route::get('/users', [\App\Http\Controllers\Api\V1\UserController::class, 'getAll'])->name('users');
Route::any('/userInsert', [\App\Http\Controllers\Api\V1\UserController::class, 'insertUser'])->name('user.insert');
Route::any('/userUpdate', [\App\Http\Controllers\Api\V1\UserController::class, 'updateUser'])->name('user.update');
Route::get('/userDelete/{id}', [\App\Http\Controllers\Api\V1\UserController::class, 'deleteUser'])->name('user.delete');
Route::get('/events', [\App\Http\Controllers\Api\V1\EventController::class, 'getAll'])->name('events');
Route::get('/event/{id}', [\App\Http\Controllers\Api\V1\EventController::class, 'getEvent'])->name('event');
Route::get('/eventDelete/{id}', [\App\Http\Controllers\Api\V1\EventController::class, 'deleteEvent'])->name('event.delete');
Route::any('/eventUpdate', [\App\Http\Controllers\Api\V1\EventController::class, 'updateEvent'])->name('event.update');
Route::any('/eventInsert', [\App\Http\Controllers\Api\V1\EventController::class, 'insertEvent'])->name('event.insert');
