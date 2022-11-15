<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Password;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Str;
use Symfony\Component\HttpFoundation\Response;

class PasswordResetController extends Controller
{

    public function forgotPassword(Request $request){

        $request->validate(['email' => 'required | email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }
        throw ValidationException::withMessages(['email' => [trans($status)]]);
    }

    public function resetPassword(Request $request){

        $request->validate([
           'token' => 'required',
           'email' => 'required|email',
           'password' => ['required', 'confirmed', RulesPassword::defaults()]
        ]);


        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
                
                $user->tokens()->delete();
                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message' => 'Password reset successful'
            ]);
        }

        return response(
            [
                'message' => __($status)
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );

    }
}