<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public static function login($request)
    {
        if (null != $user = User::where('email', '=', $request->email)->first())
        {
            if (Hash::check($request->password, $user->password))
            {
                $token = $user->createToken('my-app-token')->plainTextToken;
                return ResponseService::success(['token' => $token, 'email' => $user->email], 'successful login', 200);
            }else{
                return ResponseService::error([], 'Invalid Credentials', 404);
            }
        }else{
            return ResponseService::error([], "$request->email not found", 404);
        }
    }
}