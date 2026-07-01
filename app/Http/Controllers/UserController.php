<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

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
}
