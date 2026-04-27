<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $messages = Contact::count(); // AU DB method (sawa pia)

        return view('admin.manager.dashboard', compact('messages'));
    }
}