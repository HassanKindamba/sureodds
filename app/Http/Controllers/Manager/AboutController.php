<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Founder;

class AboutController extends Controller
{
    public function index()
    {
        $founders = Founder::latest()->get();
        return view('admin.manager.about.index', compact('founders'));
    }

    public function create()
    {
        return view('admin.manager.about.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'image' => 'nullable|image'
        ]);

        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('founders','public');
        }

        Founder::create($data);

        return redirect()->route('admin.manager.about.index')
            ->with('success','Founder added successfully');
    }

    public function show($id)
    {
        $founder = Founder::findOrFail($id);
        return view('admin.manager.about.show', compact('founder'));
    }

    public function edit($id)
    {
        $founder = Founder::findOrFail($id);
        return view('admin.manager.about.edit', compact('founder'));
    }

    public function update(Request $request, $id)
    {
        $founder = Founder::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'image' => 'nullable|image'
        ]);

        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('founders','public');
        }

        $founder->update($data);

        return redirect()->route('admin.manager.about.index')
            ->with('success','Updated successfully');
    }

    public function destroy($id)
    {
        $founder = Founder::findOrFail($id);
        $founder->delete();

        return redirect()->route('admin.manager.about.index')
    ->with('success','Deleted successfully');
    }
}
