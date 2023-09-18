<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('album.index');
});
Route::controller(AlbumController::class)->name('albums.')->prefix('/albums')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/','store')->name('store');
    Route::get('/{id}','show')->name('show');
    Route::delete('/{id}','destroy')->name('destroy');
    Route::patch('/{id}','move')->name('move');
});

