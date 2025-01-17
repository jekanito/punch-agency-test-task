<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $result = $request->user()->token()->revoke();
        if($result){
            $response = response()->json(['error'=>false,'message'=>'User logout successfully.','result'=>[]],200);
        }else{
            $response = response()->json(['error'=>true,'message'=>'Something is wrong.','result'=>[]],400);
        }
        return $response;
    }
}
