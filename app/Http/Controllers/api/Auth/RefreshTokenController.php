<?php

declare(strict_types=1);

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class RefreshTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $request->user()->tokens()->delete();

        $newToken = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'token' => $newToken,
        ], 200);
    }
}
