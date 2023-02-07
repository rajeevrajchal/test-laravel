<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
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

// Route::prefix('products')->group(function () {
//     Route::get('', [ProductController::class, 'index']);
// });

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::post('', 'store');
    Route::get('', 'index');
});

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('', 'index');
});

Route::prefix('todo')->controller(TodoController::class)->group(function () {
    Route::get('', 'index');
    Route::post('', 'store');
    Route::patch('change-status/{id}', 'changeCompleteStatus');
    Route::get('user/{userId}', 'getAllTodoWithUser');
});

Route::prefix('images')->controller(ImageController::class)->group(function () {
    Route::post('', 'create');
    Route::post('/storage', 'store');
})->name('images.upload');
