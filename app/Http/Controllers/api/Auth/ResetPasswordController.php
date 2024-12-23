<?php

declare(strict_types=1);

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

final class ResetPasswordController extends Controller
{
    public function __invoke(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password): void {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            },
        );

        if (Password::PASSWORD_RESET === $status) {
            return response()->json(['message' => __($status)], 200);
        }

        return response()->json(['message' => __($status)], 400);
    }
}
