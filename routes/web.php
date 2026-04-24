<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\PredictionsController;
use App\Http\Controllers\Frontend\PremiumController;
use App\Http\Controllers\Frontend\ContactController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('frontend.home');

Route::get('/predictions', [PredictionsController::class, 'predictions'])
    ->name('frontend.predictions');

Route::get('/premium', [PremiumController::class, 'premium'])
    ->name('frontend.premium');

Route::get('/about', [AboutController::class, 'about'])
    ->name('frontend.about');

Route::get('/contact', [ContactController::class, 'contact'])
    ->name('frontend.contact');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| DASHBOARD (DEFAULT LARAVEL)
|--------------------------------------------------------------------------
*/

// Route::get('/dashboard', function () {
//     return redirect()->route('frontend.home');
// })->middleware(['auth', 'verified']);


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (ROLE BASED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:co_operational_manager'])->group(function () {

    Route::get('/admin/manager', function () {
        return view('admin.manager');
    })->name('admin.manager');
});


Route::middleware(['auth', 'role:co_lead_developer'])->group(function () {

    Route::get('/admin/dev', function () {
        return view('admin.dev');
    })->name('admin.dev');
});