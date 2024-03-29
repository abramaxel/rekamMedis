<?php

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
    return view('beranda');
});


Route::get('/rekam-medis', function () {
    return view('rekamMedis');
});

Route::get('/master', function () {
    return view('master');
});

Route::get('/detail/{no_rm}', function ($no_rm) {
    return view('detail', ['no_rm' => $no_rm]);
});
