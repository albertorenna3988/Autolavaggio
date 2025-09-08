<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarwashController;

Route::get('/carwash/latest', [CarwashController::class, 'latestScan']);
Route::patch('/carwash/{id}', [CarwashController::class, 'updateScan']);
