<?php

namespace App\Http\Controllers;

use App\Models\RegularUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegularUserAuthController extends Controller
{
    /**
     * Show the registration form for regular users.
     */
    public function showRegisterForm()
    {
        return view('regular_users.register');
    }

    /**
     * Handle registration of a new regular user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:regular_users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.regex' => 'The name field must only contain letters and spaces.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        RegularUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('regular_users.login')->with('success', 'Registration successful! Please login to continue.');
    }

    /**
     * Show the login form for regular users.
     */
    public function showLoginForm()
    {
        return view('regular_users.login');
    }

    /**
     * Handle login for regular users.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('regular_user')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('regular_users.home'))->with('success', 'Login successful.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout for regular users.
     */
    public function logout(Request $request)
    {
        Auth::guard('regular_user')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('regular_users.login')->with('success', 'Logged out successfully.');
    }

    /**
     * Update the profile image of the regular user.
     */
    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::guard('regular_user')->user();

        if ($request->hasFile('profile_image')) {
            $imageName = time() . '_' . $user->id . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images/profiles'), $imageName);

            $user->profile_image = 'images/profiles/' . $imageName;
            $user->save();
        }

        return back()->with('success', 'Profile image updated successfully.');
    }
}
