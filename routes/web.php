<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Models\SubscriptionPlan;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\PredictionsController;
use App\Http\Controllers\Frontend\PremiumController as FrontendPremiumController;
use App\Http\Controllers\Frontend\ContactController;

use App\Http\Controllers\Manager\ChatController as ManagerChatController;

use App\Http\Controllers\PredictionFeedbackController;

use App\Http\Controllers\Dev\MonitoringController;

use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\HomeController as ManagerHomeController;
use App\Http\Controllers\Manager\AboutController as ManagerAboutController;
use App\Http\Controllers\Manager\PremiumController as ManagerPremiumController;
use App\Http\Controllers\Manager\PredictionsController as ManagerPredictionsController;
use App\Http\Controllers\Manager\UsersController as ManagerUsersController;
use App\Http\Controllers\Manager\MessagesController as ManagerMessagesController;
use App\Http\Controllers\Manager\FeedbackController as ManagerFeedbackController;

use App\Http\Controllers\Frontend\NotificationController;

use App\Http\Controllers\PaymentController;

use App\Models\User;
use App\Models\Setting;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/predictions', [PredictionsController::class, 'predictions'])->name('frontend.predictions');
Route::get('/premium', [FrontendPremiumController::class, 'premium'])->name('frontend.premium');
Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');
Route::get('/contact', [ContactController::class, 'contact'])->name('frontend.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('frontend.contact.store');

Route::post('/predictions/{prediction}/feedback', [PredictionFeedbackController::class, 'store'])
    ->name('predictions.feedback');



/*
|--------------------------------------------------------------------------
| 💬 FRONTEND CHAT
|--------------------------------------------------------------------------
*/

Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'index'])
    ->name('frontend.chat');

Route::post('/chat', [\App\Http\Controllers\ChatController::class, 'store'])
    ->middleware('auth')
    ->name('frontend.chat.store');


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

Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('frontend.notifications');

Route::get('/notifications/{id}/read', [NotificationController::class, 'read'])
    ->name('frontend.notifications.read');

Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])
    ->name('frontend.notifications.read-all');


/*
|--------------------------------------------------------------------------
| 💳 PAYMENT SYSTEM (USER INITIATE)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
->prefix('payments')
->name('payments.')
->group(function () {

    Route::post('/pay', [PaymentController::class, 'pay'])
        ->name('pay');
});

/*
|--------------------------------------------------------------------------
| 📡 PAYMENT CALLBACKS (REAL MONEY PROVIDERS)
|--------------------------------------------------------------------------
*/

Route::prefix('payment/callback')->name('payment.callback.')->group(function () {

    Route::post('/mpesa', [PaymentController::class, 'mpesaCallback'])
        ->name('mpesa');

    Route::post('/airtel', [PaymentController::class, 'airtelCallback'])
        ->name('airtel');

    Route::post('/tigo', [PaymentController::class, 'tigoCallback'])
        ->name('tigo');

    Route::post('/halopesa', [PaymentController::class, 'halopesaCallback'])
        ->name('halopesa');

});

/*
|--------------------------------------------------------------------------
| 🧠 CO-OPERATING MANAGER PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:manager'])
->prefix('admin/manager')
->name('admin.manager.')
->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('home', ManagerHomeController::class);
    Route::resource('about', ManagerAboutController::class);

    /*
    |------------------------------
    | 💎 PREMIUM SYSTEM
    |------------------------------
    */

    Route::get('/premium', [ManagerPremiumController::class, 'index'])
        ->name('premium.index');

    Route::get('/premium/users', [ManagerPremiumController::class, 'users'])
        ->name('premium.users');

    Route::get('/premium/plans', [ManagerPremiumController::class, 'plans'])
        ->name('premium.plans');

    Route::post('/premium/plans', [ManagerPremiumController::class, 'storePlan'])
        ->name('premium.plans.store');

    Route::put('/premium/plans/{plan}', [ManagerPremiumController::class, 'updatePlan'])
        ->name('premium.plans.update');

    Route::delete('/premium/plans/{plan}', [ManagerPremiumController::class, 'destroyPlan'])
        ->name('premium.plans.destroy');

    Route::get('/premium/features', [ManagerPremiumController::class, 'features'])
        ->name('premium.features');

    Route::post('/premium/features', [ManagerPremiumController::class, 'updateFeatures'])
        ->name('premium.features.update');

    Route::get('/premium/payments', [ManagerPremiumController::class, 'payments'])
        ->name('premium.payments');

    Route::get('/premium/expiry', [ManagerPremiumController::class, 'expiry'])
        ->name('premium.expiry');

    Route::get('/premium/upgrade', [ManagerPremiumController::class, 'upgrade'])
        ->name('premium.upgrade');

    Route::post('/premium/upgrade', [ManagerPremiumController::class, 'upgradeUser'])
        ->name('premium.user.upgrade');

    Route::post('/premium/downgrade/{subscription}', [ManagerPremiumController::class, 'downgradeUser'])
        ->name('premium.user.downgrade');

    /*
    |------------------------------
    | OTHER MODULES
    |------------------------------
    */

    Route::resource('predictions', ManagerPredictionsController::class);
    Route::patch(
    'predictions/{id}/status',
    [ManagerPredictionsController::class, 'updateStatus']
    )->name('predictions.status');
    Route::resource('users', ManagerUsersController::class);
    Route::resource('messages', ManagerMessagesController::class);

    Route::get('/feedback', [ManagerFeedbackController::class, 'index'])
    ->name('feedback.index');

    Route::delete('/feedback/{feedback}', [ManagerFeedbackController::class, 'destroy'])
    ->name('feedback.destroy');


    Route::post('/chat', [\App\Http\Controllers\Manager\ChatController::class, 'store'])
    ->name('chat.store');

        /*
    |--------------------------------------------------------------------------
    | 💬 COMMUNITY CHAT MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/chat', [\App\Http\Controllers\Manager\ChatController::class, 'index'])
        ->name('chat.index');

    Route::patch('/chat/{id}/pin', [\App\Http\Controllers\Manager\ChatController::class, 'pin'])
        ->name('chat.pin');

    Route::patch('/chat/{id}/unpin', [\App\Http\Controllers\Manager\ChatController::class, 'unpin'])
        ->name('chat.unpin');

    Route::delete('/chat/{id}', [\App\Http\Controllers\Manager\ChatController::class, 'destroy'])
        ->name('chat.destroy');

    Route::post('/chat/user/{userId}/ban', [\App\Http\Controllers\Manager\ChatController::class, 'ban'])
        ->name('chat.ban');

    Route::delete('/chat/ban/{id}', [\App\Http\Controllers\Manager\ChatController::class, 'unban'])
        ->name('chat.unban');
});

/*
|--------------------------------------------------------------------------
| STEP 1: SELECT PLAN
|--------------------------------------------------------------------------
*/

Route::post('/premium/select-plan', function (Request $request) {

    $request->validate([
        'plan_id' => 'required|exists:subscription_plans,id'
    ]);

    session([
        'selected_plan_id' => $request->plan_id
    ]);

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return redirect()->route('premium.checkout');

})->name('premium.select.plan');


/*
|--------------------------------------------------------------------------
| STEP 2: CHECKOUT PAGE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/premium/checkout', function () {

        $planId = session('selected_plan_id');

        if (!$planId) {

            return redirect()
                ->route('frontend.premium')
                ->with('error', 'Please select a plan first.');
        }

        $plan = SubscriptionPlan::find($planId);

        if (!$plan) {

            session()->forget('selected_plan_id');

            return redirect()
                ->route('frontend.premium')
                ->with('error', 'Selected plan not found.');
        }

        return view('premium.checkout', compact('plan'));

    })->name('premium.checkout');

});

/*
|--------------------------------------------------------------------------
| payment status page route
|--------------------------------------------------------------------------
*/

Route::get('/premium/payment/status', function () {

    $reference = session('payment_reference');

    $payment = \App\Models\Payment::where('transaction_id', $reference)->first();

    return view('frontend.payment-status', compact('payment'));

})->name('premium.payments.status');

/*
|--------------------------------------------------------------------------
| STEP 3: PAYMENT PROCESS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post(
        '/premium/payment/process',
        [PaymentController::class, 'process']
    )->name('premium.payment.process');

});


/*
|--------------------------------------------------------------------------
| STEP 4: PAYMENT SUCCESS PAGE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/premium/payment/success', function () {

        return view('premium.success');

    })->name('premium.payment.success');

});


/*
|--------------------------------------------------------------------------
| STEP 5: PAYMENT FAILED PAGE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/premium/payment/failed', function () {

        return view('premium.failed');

    })->name('premium.payment.failed');

});

/*
|--------------------------------------------------------------------------
| 🧑‍💻 LEAD DEVELOPER PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:developer'])
->prefix('admin/dev')
->name('admin.dev.')
->group(function () {

    Route::get('/', function () {
        return view('admin.dev.dashboard', [
            'users' => User::count(),
            'predictionsEnabled' => Setting::where('key','predictions_enabled')->value('value'),
            'premiumEnabled' => Setting::where('key','premium_enabled')->value('value'),
        ]);
    })->name('index');

    Route::get('/logs', function () {
        $logs = \App\Models\ActivityLog::latest()->paginate(20);
        return view('admin.dev.logs', compact('logs'));
    })->name('logs');

    Route::get('/settings', fn () => view('admin.dev.settings'))
        ->name('settings');

    Route::post('/settings', function (Request $request) {

        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Settings updated successfully');

    })->name('settings.update');

    Route::get('/logic', fn () => view('admin.dev.logic'))
        ->name('logic');

    Route::post('/logic', function (Request $request) {

        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Logic updated successfully');

    })->name('logic.update');

    Route::get('/roles', function () {

        return view('admin.dev.roles', [
            'roles' => [
                [
                    'name' => 'User',
                    'access' => 'Basic',
                    'permissions' => 'View predictions and frontend content'
                ],
                [
                    'name' => 'Co-operational Manager',
                    'access' => 'Medium',
                    'permissions' => 'Manage predictions, premium, users, home, about and messages'
                ],
                [
                    'name' => 'Co-lead Developer',
                    'access' => 'High',
                    'permissions' => 'Manage logs, settings, monitoring, logic control and developer tools'
                ],
            ]
        ]);

    })->name('roles');

    Route::get('/monitoring', [MonitoringController::class, 'index'])
        ->name('monitoring');

    Route::get('/tools', fn () => view('admin.dev.tools'))
        ->name('tools');

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