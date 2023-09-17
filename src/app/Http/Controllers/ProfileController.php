<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if (isset($request->icon)) {
            $icon = $request->icon;
        } else {
            $icon = null;
        }

        $request->user()->icon = $icon;

        $request->user()->save();

        // return Redirect::route('profile.edit')->with('status', 'profile-updated');

        return view('profile.done');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(ProfileUpdateRequest $request)
    {
        if ($request->icon_change == "yes") {
            if (isset($request->icon)) {
                $original = request()->file('icon')->getClientOriginalName();
                $icon = date('Ymd_His') . '_' . $original;
                request()->file('icon')->move('storage/images', $icon);
            } else {
                $icon = null;
            }
        } else {
            $icon = User::find($request->id)->icon;
        }

        $user = $request;

        return view('profile.check', compact('user', 'icon'));
    }

}