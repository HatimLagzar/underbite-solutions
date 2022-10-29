<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Admin\Application\ListApplicationsController;
use App\Http\Controllers\Admin\Application\QualifyController;
use App\Http\Controllers\Admin\Application\SendEmailController;
use App\Http\Controllers\Admin\Application\UnqualifyController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ShowLoginPageController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Dashboard\SubmitsDashboardController;
use App\Http\Controllers\Admin\Notification\CreateNotificationController;
use App\Http\Controllers\Admin\Notification\DeleteNotificationController;
use App\Http\Controllers\Admin\Notification\EditNotificationController;
use App\Http\Controllers\Admin\Notification\ListNotificationsController;
use App\Http\Controllers\Admin\Notification\StoreNotificationController;
use App\Http\Controllers\Admin\Notification\UpdateNotificationController;
use App\Http\Controllers\Admin\Post\CreatePostController;
use App\Http\Controllers\Admin\Post\DeletePostController;
use App\Http\Controllers\Admin\Post\EditPostController;
use App\Http\Controllers\Admin\Post\ListPostsController;
use App\Http\Controllers\Admin\Post\StorePostController;
use App\Http\Controllers\Admin\Post\UpdatePostController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Contact\ContactUsPageController;
use App\Http\Controllers\FAQ\FAQController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Middleware\SaveRequestMiddleware;
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

Route::middleware(SaveRequestMiddleware::class)->name('pages.')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/about-us', AboutController::class)->name('about');
    Route::get('/faq', FAQController::class)->name('faq');
    Route::get('/blog', BlogController::class)->name('blog');
    Route::get('/contact-us', ContactUsPageController::class)->name('contact-us');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', DashboardController::class)->name('home');
        Route::get('submits', SubmitsDashboardController::class)->name('submits');
    });

    Route::prefix('login')->group(function () {
        Route::get('/', ShowLoginPageController::class)->name('login');
        Route::post('/', LoginController::class)->name('authenticate');
    });

    Route::prefix('blog')->name('posts.')->group(function () {
        Route::get('/', ListPostsController::class)->name('index');
        Route::get('create', CreatePostController::class)->name('create');
        Route::post('/', StorePostController::class)->name('store');
        Route::get('{post}', EditPostController::class)->name('edit');
        Route::post('{post}', UpdatePostController::class)->name('update');
        Route::delete('{post}', DeletePostController::class)->name('delete');
    });

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', ListNotificationsController::class)->name('index');
        Route::get('create', CreateNotificationController::class)->name('create');
        Route::post('/', StoreNotificationController::class)->name('store');
        Route::get('{notification}', EditNotificationController::class)->name('edit');
        Route::post('{notification}', UpdateNotificationController::class)->name('update');
        Route::delete('{notification}', DeleteNotificationController::class)->name('delete');
    });

    Route::prefix('applications')->name('applications.')->group(function () {
        Route::get('/', ListApplicationsController::class)->name('index');
        Route::post('{id}/qualify', QualifyController::class)->name('qualify');
        Route::post('{id}/unqualify', UnqualifyController::class)->name('unqualify');
        Route::post('send-email', SendEmailController::class)->name('mail');
    });
});