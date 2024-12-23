<?php

declare(strict_types=1);

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

final class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email'),
        );

        if (Password::RESET_LINK_SENT === $status) {
            return response()->json(['message' => __($status)], 200);
        }

        return response()->json(['message' => __($status)], 400);
    }
}
