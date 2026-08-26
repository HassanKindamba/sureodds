<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
   public function create(Request $request): View
    {
        if ($request->query('from') === 'chat') {
            $request->session()->put('register_from_chat', true);
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        /*
        |--------------------------------------------------------------------------
        | CHAT REGISTRATION
        |--------------------------------------------------------------------------
        |
        | Kama user alikuja kwenye registration kupitia Chat,
        | tunahifadhi session ili baada ya login arudishwe Chat.
        |
        */

        if ($request->session()->get('register_from_chat')) {
            $request->session()->put('login_to_chat', true);

            // Ondoa flag ya zamani ili isitumike tena
            $request->session()->forget('register_from_chat');
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO LOGIN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('login')
            ->with('success', 'Account created successfully. Please login.');
    }
}