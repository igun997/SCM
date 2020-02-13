<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthPos extends Controller
{
  public function __construct()
  {
     $this->middleware('jwt.verify', ['except' => ['login']]);
  }
  public function login(Request $request)
  {

        $credentials = $request->only('username', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return $this->respondWithToken($token);
  }

  public function me()
  {
    return response()->json(Auth::guard()->user());
  }

  public function logout()
  {
    JWTAuth::invalidate(true);
    return response()->json(['message' => 'Successfully logged out']);
  }

  public function refresh()
  {
    return $this->respondWithToken($this->guard()->refresh());
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer'
    ]);
  }
  public function test()
  {
    return response()->json(["status"=>$this->me()]);
  }

}
