<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        try {
            $regist = $this->authService->register($data);

            return response()->json([
                'message' => 'Registration successful.',
                'token' => $this->authService->login($data),
                'token_type' => 'Bearer',
                'user' => $regist,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Password hashing failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $token = $this->authService->login($data);

            return response()->json([
                'message' => 'Login successful.',
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => Auth::user(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request);

            return response()->json([
                'message' => 'Logout successful.',
                'status_code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Logout failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
