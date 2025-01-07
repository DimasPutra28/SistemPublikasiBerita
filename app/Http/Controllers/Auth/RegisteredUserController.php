<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_login' => 'required|string|max:255|unique:users,user_login',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Ubah user_nicename menjadi slug
        $slugNicename = Str::slug($request->user_nicename, '-');

        $user = User::create([
            'user_login' => $request->user_login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_nicename' => $slugNicename, 
            'user_url' => ' ',
            'display_name' => $request->user_login,
            'role' => 'user',
            'user_registered' => now(),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('login', absolute: false));
    }
}
