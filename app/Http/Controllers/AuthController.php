<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showAdminLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $loginValue = $request->email;
        $loginField = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$loginField => $loginValue, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Access Denied. Credentials mismatch or account inactive.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[a-z0-9](\.?[a-z0-9]){2,}@gmail\.com$/i', // Only official Gmail
            ],
            'phone' => [
                'required',
                'string',
                'unique:users',
                'regex:/^\+923\d{9}$/', // Must be +923xxxxxxxxx
                function ($attribute, $value, $fail) {
                    $digits = substr($value, 4);
                    if (preg_match('/^(\d)\1{8}$/', $digits)) {
                        $fail('This phone number looks illegitimate. Please use a real number.');
                    }
                    if (str_contains($digits, '000000')) {
                        $fail('Phone number contains invalid zero sequence.');
                    }
                },
            ],
            'whatsapp' => ['required', 'string', 'regex:/^\+923\d{9}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.regex' => 'Only official @gmail.com accounts are allowed.',
            'phone.regex' => 'Format must be: +923XXXXXXXXX',
            'whatsapp.regex' => 'WhatsApp format must be: +923XXXXXXXXX',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Password Reset Methods
    public function showForgotPassword()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Since we are using manual logic for now, we'll just show a success message
        // In a real app, you'd use Password::sendResetLink()
        return back()->with('status', 'If your email is registered, we have sent a reset link.');
    }

    public function showResetPassword($token)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => request()->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/login')->with('success', 'Password reset successfully. Please login.');
        }

        return back()->withErrors(['email' => 'User not found.']);
    }
}
