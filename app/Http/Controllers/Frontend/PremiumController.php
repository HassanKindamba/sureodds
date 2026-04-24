<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    public function premium(){
        return view('frontend.premium');
    }
}
