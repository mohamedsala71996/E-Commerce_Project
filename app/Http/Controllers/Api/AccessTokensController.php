<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'abilities' => 'nullable|array'
        ]);

        $user = User::where('email', $request->input('email'))->first();
        $device_name = $request->input('device_name', $request->userAgent());
        if ($user && Hash::check($request->input('password'),  $user->password)) {

            $token = $user->createToken($device_name,$request->abilities)->plainTextToken;
            return response()->json(['token' => $token, $user], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }



    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();
        if ($token == null) {
            $token = $user->currentAccessToken()->delete();
            return response()->json(['message' => 'current access token revoked successfully']);
        }
        $PersonalAccessToken = PersonalAccessToken::findToken($token);
        if ($user->id == $PersonalAccessToken->tokenable_id && get_class($user) == $PersonalAccessToken->tokenable_type) {
            $PersonalAccessToken->delete();
            return response()->json(['message' => 'Access token revoked successfully']);
        }
        return response()->json(['message' => 'Invalid token'], 401);

        //revoke all personal access tokens (logout from all devices)
        // $user->tokens()->delete();
        // return response()->json(['message' => 'Access token revoked successfully']);
    }
}
