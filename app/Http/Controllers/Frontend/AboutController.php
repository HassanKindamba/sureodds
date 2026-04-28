<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Founder;

class AboutController extends Controller
{
    public function index()
    {
        $founders = Founder::latest()->get();

        return view('frontend.about', compact('founders'));
    }
}