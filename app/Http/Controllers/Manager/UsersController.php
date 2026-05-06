<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display users list
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.manager.user.index', compact('users'));
    }

    /**
     * Show single user
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manager.user.show', compact('user'));
    }

    /**
     * Create user form (optional)
     */
    public function create()
    {
        return view('admin.manager.user.create');
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user'
        ]);

        return redirect()->route('admin.manager.users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Edit user form
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manager.user.edit', compact('user'));
    }

    /**
     * Update user (INCLUDING ROLE)
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route('admin.manager.users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Delete user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }
}