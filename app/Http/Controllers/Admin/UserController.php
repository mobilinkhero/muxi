<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string',
            'whatsapp' => 'nullable|string',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->phone = $validated['phone'] ?? null;
        $user->whatsapp = $validated['whatsapp'] ?? null;
        $user->is_admin = $request->has('is_admin');
        $user->is_premium = $request->has('is_premium');
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|string',
            'whatsapp' => 'nullable|string',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? $user->phone;
        $user->whatsapp = $validated['whatsapp'] ?? $user->whatsapp;

        // Only update roles if it's not the current user
        if ($user->id !== Auth::id()) {
            $user->is_admin = $request->has('is_admin');
        }

        $user->is_premium = $request->has('is_premium');

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->has('reset_device_token')) {
            $user->device_token = null;
            $user->browser_fingerprint = null;
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.' . ($request->has('reset_device_token') ? ' Device lock reset.' : ''));
    }

    public function impersonate(User $user)
    {
        // Safety check
        if ($user->is_admin) {
            return back()->with('error', 'Cannot impersonate an administrator.');
        }

        $adminId = Auth::id();

        // Login as the user
        Auth::login($user);

        // Store original admin ID in the NEW session after login
        session(['impersonated_by' => $adminId]);

        return redirect()->route('dashboard');
    }

    public function stopImpersonate()
    {
        if (!session()->has('impersonated_by')) {
            return redirect()->route('dashboard');
        }

        $adminId = session('impersonated_by');
        $admin = User::findOrFail($adminId);

        // Login back as Admin
        Auth::login($admin);

        // Clear session
        session()->forget('impersonated_by');

        return redirect()->route('admin.users.index')->with('success', 'Back to Admin Terminal');
    }

    public function destroy($id)
    {
        // Avoid deleting self
        if ($id == Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user = User::findOrFail($id);

        // Permanent deletion from database
        $user->delete();

        return back()->with('success', 'User #' . $id . ' has been permanently purged from the system.');
    }

    public function resetDevice(User $user)
    {
        $user->update(['browser_fingerprint' => null]);
        return back()->with('success', "Device limit reset for {$user->name}. They can now login from a new device.");
    }

    public function securityLogs()
    {
        $users = User::whereNotNull('last_login_ip')
            ->orWhereNotNull('latitude')
            ->latest()
            ->paginate(20);

        return view('admin.security.logs', compact('users'));
    }
}
