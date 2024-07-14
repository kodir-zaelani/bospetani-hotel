<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

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
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'avatar'   => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

         if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('images/avatars/' . date('Y/m/d'));
                $validated['avatar'] = $avatarPath;
            }

        $user = User::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'avatar'   => $avatarPath,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $rolecustomer        = Role::find('9c5a0257-95a2-453e-9ced-d562870e93ba');
        $user->assignRole($rolecustomer->name);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
