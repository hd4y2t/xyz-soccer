<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthService
{
    public function login(array $credentials): ?string
    {
        if (empty($credentials['email']) || empty($credentials['password'])) {
            return throw new \Exception('Invalid credentials');
        }

        if (!Auth::attempt($credentials)) {
            return throw new \Exception('Invalid credentials');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        return $user->createToken('api-token')->plainTextToken;
    }

    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function user(): ?User
    {
        return Auth::user();
    }
}
