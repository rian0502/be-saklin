<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function loginMobile(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password.'],
            ]);
        }

        $user->tokens()->where('name', 'mobile-token')->delete();

        $token = $user->createToken('mobile-token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions()->pluck('name'),
            'token' => $token,
        ]);
    }

    public function logoutMobile()
    {
        request()->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Mobile logout successful.']);
    }

    public function login(LoginRequest $request)
    {
        if (! Auth::guard('web')->attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password.'],
            ]);
        }

        $request->session()->regenerate();
        $user = Auth::guard('web')->user();

        return response()->json([
            'user' => new UserResource($user),
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions()->pluck('name'),
        ]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return response()->json(['message' => 'Web logout successful.']);
    }

    public function me()
    {
        $user = request()->user();

        return response()->json([
            'user' => new UserResource($user),
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getAllPermissions()->pluck('name'),
        ]);
    }
}
