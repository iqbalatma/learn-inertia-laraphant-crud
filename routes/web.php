<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("test", [\App\Http\Controllers\EventController::class, "index"]);

Route::get("posts", [\App\Http\Controllers\PostController::class, "index"]);


Route::prefix("customers")->name("customers.")->controller(CustomerController::class)->group(function (){
    Route::get("", "index")->name("index");
    Route::get("create", "create")->name("create");
    Route::get("edit/{customer}", "edit")->name("edit");
    Route::post("", "store")->name("store");
    Route::delete("{customer}", "destroy")->name("destroy");
    Route::put("{customer}", "update")->name("update");
});
