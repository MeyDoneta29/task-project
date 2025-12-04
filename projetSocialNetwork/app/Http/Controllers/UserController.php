<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signup(Request $request)
    {
       $user=User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password)
       ]);
         return response()->json([
              'message'=>'inscription reussie',
              'user'=>$user
         ]);
    }

    public function signin(Request $request){
        $credentials=$request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        if(auth()->attempt($credentials)){
            $user=auth()->user();
            $token=$user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message'=>'connexion reussie',
                'user'=>$user,
                'token'=>$token,
            ]);
        }
        return response()->json([
            'message'=>'identifiants invalides'
        ], 401);

    }

}
