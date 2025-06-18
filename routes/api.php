<?php

use App\Http\Controllers\AuctionSchemaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Category;
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

Route::prefix("user")->group(function () {
    Route::get("/detail", [UserController::class, "detail"]);
});


Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'get']);
    Route::post('/create', [CategoryController::class, 'create']);
    Route::post('/update', [CategoryController::class, 'update']);
    Route::delete('/delete', [CategoryController::class, 'delete']);
});


Route::prefix('listing')->group(function () {

    Route::get("/detail", [ListingController::class, "detail"]);
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
