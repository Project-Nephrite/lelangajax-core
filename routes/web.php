<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return new JsonResponse([
        "message" => "This is the index route"
    ]);
})->name("index");


use App\Http\Controllers\AzureUploadController;

Route::get('/azure-upload', [AzureUploadController::class, 'form']);
Route::post('/azure-upload', [AzureUploadController::class, 'upload'])->name('azure.upload');
