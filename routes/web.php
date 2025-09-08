<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\FidelityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


Route::get('/live-url', function (Request $req) {
    $res = Http::get('https://api.softwarehouse.com/live'); // URL da inserire appena me lo forniscono
    return response()->json(['url' => $res->json('stream_url')]);
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/servizi', [ServicesController::class, 'index'])->name('services');
Route::get('/dove-siamo', [LocationController::class, 'index'])->name('location');
Route::get('/live', [LiveController::class, 'index'])->name('live');
Route::get('/fidelity-card', [FidelityController::class, 'index'])->name('fidelity');
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy');
Route::get('/chi-siamo', function () {
    return view('about');
})->name('about');
Route::get('/prezzi', function () {
    return view('prezzi');
})->name('prezzi');
Route::get('/prezzi', function () {
    return view('prezzi');
})->name('prezzi');
