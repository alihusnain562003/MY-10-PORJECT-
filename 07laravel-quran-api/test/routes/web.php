<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Quran;


Route::get('/', [Quran::class , "getcontents"]);
Route::get('/read/{snum}', [Quran::class , "getcontentsDetails"]);


Route::get('/surah', [Quran::class, 'getcontents'])->name('quran.surah');
Route::get('/surah/{snum}', [Quran::class, 'getcontentsDetails'])->name('quran.surah.details');
