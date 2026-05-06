<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\BetSlip;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.manager.dashboard', [
            'users' => User::count(),
            'messages' => Contact::count(),
            'predictions' => BetSlip::count(),
        ]);
    }
}
