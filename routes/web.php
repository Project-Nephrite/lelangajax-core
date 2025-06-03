<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return new JsonResponse([
        "message" => "This is the index route"
    ]);
})->name("index");
