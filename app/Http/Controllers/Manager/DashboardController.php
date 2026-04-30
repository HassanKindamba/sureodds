<?php

 namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\BetSlip; // 👈 add hii

class DashboardController extends Controller
{
    public function index()
    {
        $messages = Contact::count();

        $predictions = BetSlip::count(); // 👈 ADD HII (mikeka/predictions)

        return view('admin.manager.dashboard', compact(
            'messages',
            'predictions'
        ));
    }
}
