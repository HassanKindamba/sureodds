<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Models\SubscriptionPlan;
use App\Models\Payment;
use App\Models\PremiumFeature;
use App\Models\User;

class PremiumController extends Controller
{

public function index()
{
    $totalUsers = User::count();

    $activeSubscriptions = UserSubscription::where('status', 'active')->count();

    $expiredSubscriptions = UserSubscription::where('status', 'expired')->count();

    $totalRevenue = Payment::where('status', 'success')->sum('amount');

    $monthlyRevenue = Payment::where('status', 'success')
        ->whereMonth('created_at', now()->month)
        ->sum('amount');

    $revenueData = Payment::selectRaw('DATE(created_at) as date, SUM(amount) as total')
        ->where('status', 'success')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    return view('admin.manager.premium.dashboard', compact(
        'totalUsers',
        'activeSubscriptions',
        'expiredSubscriptions',
        'totalRevenue',
        'monthlyRevenue',
        'revenueData'
    ));
}

    public function users()
    {
        $subscriptions = UserSubscription::with(['user','plan'])
            ->orderBy('status', 'asc')   // active zianze kwanza
            ->orderBy('expires_at', 'desc')
            ->latest()
            ->get();

        return view(
            'admin.manager.premium.users',
            compact('subscriptions')
        );
    }

    public function plans()
    {
        $plans = SubscriptionPlan::latest()->get();

        return view(
            'admin.manager.premium.plans',
            compact('plans')
        );
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration_days' => 'required|integer',
        ]);

        SubscriptionPlan::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'description' => $request->description,
            'status' => true,
        ]);

        return back()->with('success', 'Plan created successfully');
    }

    public function updatePlan(Request $request, SubscriptionPlan $plan)
    {
        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Plan updated successfully');
    }

    public function destroyPlan(SubscriptionPlan $plan)
    {
        $plan->delete();

        return back()->with('success', 'Plan deleted successfully');
    }

    public function features()
    {
        $features = PremiumFeature::all();

        return view(
            'admin.manager.premium.features',
            compact('features')
        );
    }

    public function updateFeatures(Request $request)
    {
        $features = \App\Models\PremiumFeature::all();

        foreach ($features as $feature) {

            $feature->update([
                'enabled' => isset($request->features[$feature->id])
            ]);

        }

        return back()->with('success', 'Features updated successfully');
    }

    public function payments()
    {
        $payments = Payment::with('user')
            ->latest()
            ->get();

        $totalRevenue = Payment::where('status','success')->sum('amount');

        return view(
            'admin.manager.premium.payments',
            compact('payments','totalRevenue')
        );
    }

    public function expiry()
    {
        $active = UserSubscription::with(['user','plan'])
            ->where('status', 'active')
            ->get();

        $expired = UserSubscription::with(['user','plan'])
            ->where('status', 'expired')
            ->latest()
            ->get();

        $expiringSoon = UserSubscription::with(['user','plan'])
            ->where('status', 'active')
            ->where('expires_at', '<=', now()->addDays(3))
            ->get();

        return view(
            'admin.manager.premium.expiry',
            compact('active','expired','expiringSoon')
        );
    }

    public function upgrade()
    {
        $users = User::orderBy('name')->get();
        $plans = SubscriptionPlan::where('status', true)->get();

        return view(
            'admin.manager.premium.upgrade',
            compact('users', 'plans')
        );
    }


    public function upgradeUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'plan_id' => 'required',
        ]);

        $plan = SubscriptionPlan::findOrFail($request->plan_id);

        // 1. Create Subscription
        $subscription = UserSubscription::create([
            'user_id' => $request->user_id,
            'subscription_plan_id' => $plan->id,
            'starts_at' => now(),
            'expires_at' => now()->addDays($plan->duration_days),
            'status' => 'active',
        ]);

        // 2. Create Payment Record
        Payment::create([
            'user_id' => $request->user_id,
            'amount' => $plan->price,
            'method' => 'manual',
            'transaction_id' => 'MAN-' . time(),
            'status' => 'success',
        ]);

        return back()->with('success', 'User upgraded + payment recorded');
    }

    public function downgradeUser(UserSubscription $subscription)
    {
        $subscription->update([
            'status' => 'expired'
        ]);

        return back()->with('success', 'User downgraded successfully');
    }
}