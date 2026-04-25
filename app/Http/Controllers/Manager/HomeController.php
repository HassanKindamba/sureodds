<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // SHOW FORM (EDIT SINGLE RECORD)
    public function index()
    {
        $home = Home::first(); // single record system
        return view('admin.manager.home.index', compact('home'));
    }

    // SAVE / UPDATE
    public function store(Request $request)
    {
        $home = Home::first();

        if (!$home) {
            $home = new Home();
        }

        $home->title = $request->title;
        $home->description = $request->description;

        $home->stat_accuracy_label = $request->stat_accuracy_label;
        $home->stat_accuracy_value = $request->stat_accuracy_value;

        $home->stat_members_label = $request->stat_members_label;
        $home->stat_members_value = $request->stat_members_value;

        $home->stat_picks_label = $request->stat_picks_label;
        $home->stat_picks_value = $request->stat_picks_value;

        $home->stat_experience_label = $request->stat_experience_label;
        $home->stat_experience_value = $request->stat_experience_value;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('home', 'public');
            $home->image = $path;
        }

        $home->save();

        return back()->with('success', 'Home updated successfully');
    }
}