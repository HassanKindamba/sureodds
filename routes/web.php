<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\PredictionsController;
use App\Http\Controllers\Frontend\PremiumController;
use App\Http\Controllers\Frontend\ContactController;


use App\Http\Controllers\Manager\HomeController as ManagerHomeController;
use App\Http\Controllers\Manager\AboutController as ManagerAboutController;
use App\Http\Controllers\Manager\PremiumController as ManagerPremiumController;
use App\Http\Controllers\Manager\PredictionsController as ManagerPredictionsController;
use App\Http\Controllers\Manager\UsersController as ManagerUsersController;
use App\Http\Controllers\Manager\MessagesController as ManagerMessagesController;

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
Route::post('/contact', [ContactController::class, 'store'])
    ->name('frontend.contact.store');


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
Route::middleware(['auth', 'role:co_operational_manager'])
->prefix('admin/manager')
->name('admin.manager.')
->group(function () {

    Route::get('/', function () {
        return view('admin.manager.dashboard');
    })->name('dashboard');

    // HOME
    Route::resource('home', ManagerHomeController::class);

    // ABOUT
    Route::resource('about', ManagerAboutController::class);

    // PREMIUM
    Route::resource('premium', ManagerPremiumController::class);

    // PREDICTIONS
    Route::resource('predictions', ManagerPredictionsController::class);

    // USERS
    Route::resource('users', ManagerUsersController::class);

    // MESSAGES
    Route::resource('messages', ManagerMessagesController::class);
});





Route::middleware(['auth', 'role:co_lead_developer'])
    ->prefix('admin/dev')
    ->name('admin.dev.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dev.dashboard'); // better kuliko string
        })->name('index');

        Route::get('/logs', function () {
            return view('admin.dev.logs');
        })->name('logs');

        Route::get('/settings', function () {
            return view('admin.dev.settings');
        })->name('settings');

    });