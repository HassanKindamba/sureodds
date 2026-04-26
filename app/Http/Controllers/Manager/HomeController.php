<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // =========================
    // INDEX (display + edit form)
    // =========================
   public function index()
    {
        $home = Home::first();

        return view('admin.manager.home.index', compact('home'));
    }

    // =========================
    // CREATE PAGE
    // =========================
    public function create()
    {
        return view('admin.manager.home.create');
    }

    // =========================
    // STORE (CREATE OR UPDATE)
    // =========================
    public function store(Request $request)
    {
        $home = Home::first() ?? new Home();

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

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('home', 'public');
            $home->image = $path;
        }

        $home->save();

        return redirect()->route('admin.manager.home.index')
            ->with('success', 'Home saved successfully');
    }

    // =========================
    // SHOW
    // =========================
    public function show($id)
    {
        $home = Home::findOrFail($id);
        return view('admin.manager.home.show', compact('home'));
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $home = Home::findOrFail($id);
        return view('admin.manager.home.edit', compact('home'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $home = Home::findOrFail($id);

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

        // IMAGE UPDATE
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('home', 'public');
            $home->image = $path;
        }

        $home->save();

        return redirect()->route('admin.manager.home.index')
            ->with('success', 'Home updated successfully');
    }

    // =========================
    // DELETE (optional)
    // =========================
    public function destroy($id)
    {
        $home = Home::findOrFail($id);
        $home->delete();

        return redirect()->route('admin.manager.home.index')
            ->with('success', 'Home deleted');
    }
}