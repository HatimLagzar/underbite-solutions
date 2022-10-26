<?php

use App\Http\Controllers\Api\Contact\ContactUsController;
use App\Http\Controllers\Api\Patient\ApplyController;
use App\Http\Middleware\SaveRequestMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('apply', ApplyController::class)->middleware(SaveRequestMiddleware::class)->name('apply');
Route::post('contact-us', ContactUsController::class);
