<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ShowLoginPageController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Contact\ContactUsPageController;
use App\Http\Controllers\FAQ\FAQController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('pages.')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/about-us', AboutController::class)->name('about');
    Route::get('/faq', FAQController::class)->name('faq');
    Route::get('/blog', BlogController::class)->name('blog');
    Route::get('/contact-us', ContactUsPageController::class)->name('contact-us');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('home');

    Route::prefix('login')->group(function () {
        Route::get('/', ShowLoginPageController::class)->name('login');
        Route::post('/', LoginController::class)->name('authenticate');
    });
});