<?php

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index']);
Route::middleware('auth')->group(function() {
    Route::prefix('/category')->group(function () {
        Route::get('/insert', \App\Http\Controllers\Category\InsertCategoryController::class)->name('category.insert');
        Route::get('/get', \App\Http\Controllers\Category\GetCategoryController::class)->name('category.get');
        Route::get('/update', \App\Http\Controllers\Category\UpdateCategoryController::class)->name('category.update');
        Route::get('/', \App\Http\Controllers\Category\CategoryController::class)->name('category.index');
        Route::get('/delete', \App\Http\Controllers\Category\DeleteCategoryController::class)->name('category.delete');
    });

    Route::prefix('/event')->group(function () {
        Route::get('/', [\App\Http\Controllers\Event\EventController::class, 'index'])->name('event.index');
        Route::get('/show/{id}', [\App\Http\Controllers\Event\EventController::class, 'show'])->name('event.show');
        Route::get('/insert', [\App\Http\Controllers\Event\InsertEventController::class, 'index'])->name('event.show.insert');
        Route::any('/insertEvent', [\App\Http\Controllers\Event\InsertEventController::class, 'insert'])->name('event.insert');
        Route::get('/delete/{id}', \App\Http\Controllers\Event\DeleteEventController::class)->name('event.delete');
        Route::get('/update/{id}', [\App\Http\Controllers\Event\UpdateEventController::class, 'index'])->name('event.show.update');
        Route::any('/updateEvent', [\App\Http\Controllers\Event\UpdateEventController::class, 'update'])->name('event.update');
    });
    Route::prefix('/user')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\UserController::class, 'index'])->name('user.index');
        Route::get('/info/{id}', [\App\Http\Controllers\User\UserController::class, 'info'])->name('user.info');
        Route::get('/insert', [\App\Http\Controllers\User\InsertUserController::class, 'index'])->name('user.insert');
        Route::any('/addUser', [\App\Http\Controllers\User\InsertUserController::class, 'insert'])->name('user.add');
        Route::get('/delete/{id}', \App\Http\Controllers\User\DeleteUserController::class)->name('user.delete');
        Route::get('/update/{id}', [\App\Http\Controllers\User\UpdateUserController::class, 'index'])->name('user.update');
        Route::any('/updateUser', [\App\Http\Controllers\User\UpdateUserController::class, 'update'])->name('user.update.info');
        Route::get('/event/{id}', [\App\Http\Controllers\User\InsertUserEventController::class, 'index'])->name('user.show.event');
        Route::any('/addEvent/{id}', [\App\Http\Controllers\User\InsertUserEventController::class, 'insert'])->name('user.insert.event');
        Route::get('/showEvents/{id}', \App\Http\Controllers\User\ShowUserEventsController::class)->name('user.events');
        Route::get('/deleteEvents/{id}', \App\Http\Controllers\User\DeleteUserEventController::class)->name('user.delete.event');
        Route::get('/changeEvent/{id}', [\App\Http\Controllers\User\UpdateUserEventController::class, 'index'])->name('user.update.show.event');
        Route::any('/updateEvent', [\App\Http\Controllers\User\UpdateUserEventController::class, 'update'])->name('user.update.event');
    });
    Route::get('/logout', [\App\Http\Controllers\AuthenticationController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function (){
    Route::get('/register', [\App\Http\Controllers\RegistrationController::class, 'register'])->name('register.index');
    Route::post('/register_store', [\App\Http\Controllers\RegistrationController::class, 'store'])->name('register.store');
    Route::get('/login', [\App\Http\Controllers\AuthenticationController::class, 'index'])->name('login');
    Route::post('/auth', [\App\Http\Controllers\AuthenticationController::class, 'authenticator'])->name('login.auth');

    Route::get('/oauth/facebook', [\App\Http\Controllers\OAuth\SocialController::class, 'facebook'])->name('facebook');
});


