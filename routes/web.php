<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[\App\Http\Controllers\mainController::class,'index']);
Route::post('home/post',[\App\Http\Controllers\mainController::class,'post_it'])->name('main.store');
Route::delete('/home/{id}/delete',[\App\Http\Controllers\mainController::class,'delete_it'])->name('delete');
