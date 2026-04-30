<?php

namespace App\Http\Controllers\Api\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $affiliate = Affiliate::create([
            'user_id' => $user->id,
            'referral_code' => $this->generateUniqueReferralCode(),
            'status' => 'active',
        ]);

        $token = $user->createToken('affiliate_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'affiliate' => $affiliate,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = Auth::user();
        return $this->respondWithToken($user);
    }

    public function googleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'google_id' => 'required',
            'name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Str::random(24)),
                'role' => 'member', // Default role
            ]);
        }

        return $this->respondWithToken($user);
    }

    private function respondWithToken($user)
    {
        $affiliate = $user->affiliate;

        if (!$affiliate) {
            $affiliate = Affiliate::create([
                'user_id' => $user->id,
                'referral_code' => $this->generateUniqueReferralCode(),
                'status' => 'active',
            ]);
        }

        $token = $user->createToken('affiliate_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'affiliate' => $affiliate,
            'token' => $token,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'affiliate' => $user->affiliate,
        ]);
    }

    private function generateUniqueReferralCode()
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Affiliate::where('referral_code', $code)->exists());

        return $code;
    }
}
