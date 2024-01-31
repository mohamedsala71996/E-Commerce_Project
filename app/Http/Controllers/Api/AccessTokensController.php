<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccessTokensController extends Controller
{

    public function store(Request $request)
    {

       $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        $device_name=$request->input('device_name', $request->userAgent());
        if ($user && Hash::check($request->input('password'),  $user->password)) {

            $token = $user->createToken($device_name)->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

    }
}
