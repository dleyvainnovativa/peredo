<?php

use App\Http\Controllers\ContisignController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index']);
Route::get('/request', function () {
    return view('pages.warehouse');
});
Route::get('/almacen', function () {
    return view('pages.requests');
});
// Route::get('/validate', [RequestController::class, 'validate']);
Route::post('/employees/search', [PageController::class, 'search']);
Route::post('contisign/send', [ContisignController::class, 'generateDocument']);
