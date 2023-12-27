<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Route::get('/search', [App\Http\Controllers\UserController::class, 'search'])->name('search');
    // Route::post('/chat', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');
    // Route::get('/contacts', [App\Http\Controllers\ChatController::class, 'contacts'])->name('chat.contacts');

    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{uuid}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');

    Route::get('/messages/{uuid}', [App\Http\Controllers\MessageController::class, 'listMessages'])->name('messages.listMessages');

    Route::post('/messages/store', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');


});
