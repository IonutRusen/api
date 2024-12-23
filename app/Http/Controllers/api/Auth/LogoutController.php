<?php

declare(strict_types=1);

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out.',
        ], 200);
    }
}
