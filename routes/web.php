<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\PredictionsController;
use App\Http\Controllers\Frontend\PremiumController;
use App\Http\Controllers\Frontend\ContactController;

use App\Http\Controllers\Dev\MonitoringController;

use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\HomeController as ManagerHomeController;
use App\Http\Controllers\Manager\AboutController as ManagerAboutController;
use App\Http\Controllers\Manager\PremiumController as ManagerPremiumController;
use App\Http\Controllers\Manager\PredictionsController as ManagerPredictionsController;
use App\Http\Controllers\Manager\UsersController as ManagerUsersController;
use App\Http\Controllers\Manager\MessagesController as ManagerMessagesController;

use App\Models\User;
use App\Models\Setting;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/predictions', [PredictionsController::class, 'predictions'])->name('frontend.predictions');
Route::get('/premium', [PremiumController::class, 'premium'])->name('frontend.premium');
Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');
Route::get('/contact', [ContactController::class, 'contact'])->name('frontend.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('frontend.contact.store');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| CO-OPERATIONAL MANAGER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:manager'])
->prefix('admin/manager')
->name('admin.manager.')
->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('home', ManagerHomeController::class);
    Route::resource('about', ManagerAboutController::class);
    Route::resource('premium', ManagerPremiumController::class);
    Route::resource('predictions', ManagerPredictionsController::class);
    Route::resource('users', ManagerUsersController::class);
    Route::resource('messages', ManagerMessagesController::class);

});


/*
|--------------------------------------------------------------------------
| LEAD DEVELOPER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:co_lead_developer'])
->prefix('admin/dev')
->name('admin.dev.')
->group(function () {

    /*
    |--------------------------
    | DASHBOARD
    |--------------------------
    */
    Route::get('/', function () {

        return view('admin.dev.dashboard', [
            'users' => User::count(),
            'predictionsEnabled' => Setting::where('key','predictions_enabled')->value('value'),
            'premiumEnabled' => Setting::where('key','premium_enabled')->value('value'),
        ]);

    })->name('index');


    /*
    |--------------------------
    | LOGS
    |--------------------------
    */
    Route::get('/logs', function () {
        $logs = \App\Models\ActivityLog::latest()->paginate(20);
        return view('admin.dev.logs', compact('logs'));
    })->name('logs');


    /*
    |--------------------------
    | SETTINGS
    |--------------------------
    */
    Route::get('/settings', function () {
        return view('admin.dev.settings');
    })->name('settings');

    Route::post('/settings', function (Request $request) {

        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Settings updated successfully');

    })->name('settings.update');


    /*
    |--------------------------
    | LOGIC CONTROL
    |--------------------------
    */
    Route::get('/logic', function () {
        return view('admin.dev.logic');
    })->name('logic');

    Route::post('/logic', function (Request $request) {

        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Logic updated successfully');

    })->name('logic.update');


    /*
    |--------------------------
    | SYSTEM MONITORING
    |--------------------------
    */
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');


    /*
    |--------------------------
    | DEV TOOLS
    |--------------------------
    */
    Route::get('/tools', function () {
        return view('admin.dev.tools');
    })->name('tools');

    Route::post('/tools/clear', function () {

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return back()->with('success', 'Cache cleared successfully');

    })->name('tools.clear');

    Route::post('/tools/optimize', function () {

        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');

        return back()->with('success', 'App optimized successfully');

    })->name('tools.optimize');

    Route::get('/tools/debug', function () {

        return response()->json([
            'app_name' => config('app.name'),
            'environment' => app()->environment(),
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
        ]);

    })->name('tools.debug');

});