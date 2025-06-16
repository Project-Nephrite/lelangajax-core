<?php

use App\Http\Controllers\AuctionSchemaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post("register", [AuthController::class, 'register']);
    Route::post("login", [AuthController::class, 'login']);


    Route::middleware("auth:sanctum")->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});


Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'get']);
    Route::post('/create', [CategoryController::class, 'create']);
});


Route::prefix('listing')->group(function () {

    Route::middleware("auth:sanctum")->group(function () {
        Route::post('create', [ListingController::class, "create"]);
        Route::get('myLists', [ListingController::class, "myLists"]);
        Route::put('update', [ListingController::class, 'update']);
    });

    Route::get('search', [ListingController::class, 'search']);
});

Route::prefix('auction-schema')->group(function () {
    Route::get('/', [AuctionSchemaController::class, 'get']);
    Route::post('/create', [AuctionSchemaController::class, 'create']);
});
