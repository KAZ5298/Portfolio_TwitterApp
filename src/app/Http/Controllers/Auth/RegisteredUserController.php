<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Http\Requests\Auth\RegisterRequest;

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
    public function store(RegisterRequest $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'nickname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nickname' => $request->nickname,
            'icon' => $request->icon,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);
        // return redirect(RouteServiceProvider::REGISTERDONE, $user);
        return view('auth.done', compact('user'));
    }

    public function show(RegisterRequest $request)
    {
        $user = $request;

        if (isset($request->icon)) {
            $original = request()->file('icon')->getClientOriginalName();
            $icon = date('Ymd_His') . '_' . $original;
            request()->file('icon')->move('storage/images', $icon);
        } else {
            $icon = null;
        }

        return view('auth.check', compact('user', 'icon'));
    }

    public function loginRedirect(User $user): RedirectResponse
    {
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}