<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function login(Request $request){
        
        
        if ( Auth::attempt($request->only('email', 'password'))){
            
            $user = Auth::user();
            
            $token = $user->createToken('admin')->accessToken;

            return ([

                'token' => $token
            ]);

        }

        return response([
            'error' => 'invalid credentials'
        ], Response::HTTP_UNAUTHORIZED);
    }

   public function register(Request $request){

        $user = User::create($request->only('first_name', 'last_name', 'email') 
        + ['password' => Hash::make($request->input('password'))]);

        return response($user, Response::HTTP_CREATED);
   }
}
