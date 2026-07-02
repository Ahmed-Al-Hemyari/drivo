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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function profile(User $user)
    {
        $user = Auth::user();

        return Inertia::render('profile');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        // 1. Validation Rules matching Filament parameters
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'], // matches your accepted types
            'delete_avatar' => ['nullable', 'boolean'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // 2. Action: Delete Existing Avatar File Asset
        if ($request->boolean('delete_avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = null;
        }

        // 3. Action: Replicate Filament's saveUploadedFileUsing Custom Lifecycle
        if ($request->hasFile('avatar')) {
            // Clean up old file first if it exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $file = $request->file('avatar');

            // Match: $name = $get('name') ?? 'avatar';
            $name = $request->input('name') ?? 'avatar';
            $filename = Str::slug($name);

            // Match: Image::decode($file) and transcode to webp
            $image = Image::decode($file);
            $encoded = $image->encodeUsingFileExtension('webp', quality: 80);

            // Match: Path format 'uploads/img/users/slug-timestamp.webp'
            $webpPath = 'uploads/img/users/' . $filename . '-' . now()->format('YmdHis') . '.webp';

            // Write file raw contents onto storage disk
            Storage::disk('public')->put($webpPath, (string) $encoded);

            // Commit the relative file path to the database column just like Filament saves its record state
            $user->avatar = $webpPath;
        }

        $user->save();

        return back();
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
