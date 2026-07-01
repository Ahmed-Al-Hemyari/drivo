<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settings\PasswordUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function profile(User $user)
    {
        $user = Auth::user();

        return Inertia::render('profile');
    }

    public function update(Request $request, User $user)
    {
        $user = Auth::user();
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => [
                'required',
                'email',
                "unique:users,email,{$user->id},id"
            ],
            'phoneـnumber' => ['string', 'regex:/^\+?[0-9\s\-]{7,20}$/'],
        ]);

        $user->update($formFields);

        return redirect('/')->with('success', __('Profile updated successfully'));
    }

    public function resetPasswordView(Request $request, User $user) {
        return Inertia::render('auth/reset-password', [
            'token' => $request->route('token'),
            'passwordRules' => Password::defaults()->toPasswordRulesString(),
            'title' => __('Reset password'),
            'description' => __('Please enter your old pasword along with new password below'),
        ]);
    }

    public function updatePassword(Request $request, User $user)
    {
        $user = $request->user();
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed', Password::defaults()],
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => __('The provided password does not match your current password.')
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect('/')->with('success', __('Password updated successfully!'));
    }
}
