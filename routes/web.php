<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\FingerSpeechController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/about', function () {
    return view('about.index');
})->name('about');

Route::get('/finger-speech', [FingerSpeechController::class, 'index'])->name('finger-speech');

Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::post('/process-image', [ImageController::class, 'processImage'])->name('process-image');

require __DIR__.'/auth.php';
