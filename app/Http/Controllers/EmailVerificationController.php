<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Symfony\Component\HttpFoundation\Response;

class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request){

        if($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Already verified!'
            ];
        }
        $request->user()->sendEmailVerificationNotification();
        return ['status' => 'verification-link-sent'];

    }

    public function verify(EmailVerificationRequest $request){
        if($request->user()->hasVerifiedEmail()) {
            return response([
                'message' => 'Email already verified'
            ]);
        }

        if($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response([
            'message' => 'Email has been verified'
        ]);
    }
}
