<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    // public function verify(Request $request, $id){
    //     if(!$request->hasValidSignature()){
    //         return $this->respondUnauthorizedRequest();
    //     }

    //     $user = User::findOrFail($id);
    //     if (!$user->hasVerifiedEmail()) {
    //         $user->markEmailAsVerified();
    //     }
    //     return redirect()->to('/');
    // }

    // public function resend(){
    //     if(auth()->user()->hasVerifiedEmail()) {
    //         return $this->respondBadRequest();
    //     }
    // }
}
