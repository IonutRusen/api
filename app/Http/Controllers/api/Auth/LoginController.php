<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
                'errors' => [
                    'email' => ['The provided email or password is incorrect.'],
                ],
            ], 401);
        }

        $user = $request->user();
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token
        ], 200);
    }
}
