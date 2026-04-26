<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Home; // 👈 HAPA NDIPO SAHIHI
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
        {
            $home = Home::first();

            return view('frontend.home', compact('home'));
        }
}