<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[a-z0-9](\.?[a-z0-9]){2,}@gmail\.com$/i', // Only real Gmail accounts
            ],
            'phone' => [
                'required',
                'string',
                'unique:users',
                'regex:/^\+923\d{9}$/', // Must be +923xxxxxxxxx
                function ($attribute, $value, $fail) {
                    // Prevent fake numbers like +923000000000, +923111111111, etc.
                    $digits = substr($value, 4); // Get the 9 digits after +923
                    if (preg_match('/^(\d)\1{8}$/', $digits)) {
                        $fail('This phone number looks fake. Please provide a valid active number.');
                    }
                    if (str_contains($digits, '000000')) {
                        $fail('Phone number cannot contain too many consecutive zeros.');
                    }
                },
            ],
            'whatsapp' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.regex' => 'Only official @gmail.com accounts are allowed. Temporary or other email providers are strictly prohibited.',
            'phone.regex' => 'Phone number must be in the format: +923xxxxxxxxx (13 characters total).',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'whatsapp' => $data['whatsapp'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
