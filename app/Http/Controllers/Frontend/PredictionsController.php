<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PredictionsController extends Controller
{
    public function predictions(){
        return view('frontend.predictions');
    }
}
