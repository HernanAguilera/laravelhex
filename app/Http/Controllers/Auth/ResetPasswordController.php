<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\GenerateTokenResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function generate_token(GenerateTokenResetPasswordRequest $request) {
        
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) 
            return response()->json([
                'status' => $status
            ]);
        return response()->json([
            'email' => $status
        ], 422);
    }

    public function change_password(ChangePasswordRequest $request) {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET)
            return response()->json([
                'status' => $status
            ]);
        return response()->json([
            'email' => $status
        ], 422);
    }
}
