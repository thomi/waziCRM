<?php

use App\Http\Controllers\AccessTokenController;
use App\Http\Resources\UserResource;
use App\Models\User;
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

Route::prefix('v1')->group(function () {

    Route::get('/user/{id}', function ($id) {
        return new UserResource(User::findOrFail($id));
    });

    Route::controller(AccessTokenController::class)->name('token.')->group(function () {
        Route::post('authorize/token/new', 'create')->name('create');
        Route::post('authorize/token', 'store')->name('store');
        Route::delete('authorize/token/revoke', 'destroy')->name('delete');
    });
});