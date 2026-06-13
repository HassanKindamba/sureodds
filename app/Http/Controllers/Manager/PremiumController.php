<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    public function index()
    {
        return view('admin.manager.premium.dashboard');
    }
    public function users()
    {
        return view('admin.manager.premium.users');
    }

    public function plans()
    {
        return view('admin.manager.premium.plans');
    }

    public function features()
    {
        return view('admin.manager.premium.features');
    }

    public function payments()
    {
        return view('admin.manager.premium.payments');
    }

    public function expiry()
    {
        return view('admin.manager.premium.expiry');
    }

    public function upgrade()
    {
        return view('admin.manager.premium.upgrade');
    }
}