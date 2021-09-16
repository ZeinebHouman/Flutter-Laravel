<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    //Register User
    public function register(Request $request){
        $attrs = $request->validate([
            'name' => 'required | string',
            'email' => 'required | email',
            'password' => 'required | min: 6 |confirmed',
        ]);

        $user = User::create([
            'name' => $attrs['name'],
            'email' => $attrs['email'] ,
            'password' => bcrypt($attrs['password']),  
          
        ]);

        return response([
        'user'=> $user, 
        'token' => $user->createToken('secret')->plainTextToken
    
        ],200);
    }

         //login User
         public function login(Request $request){
            $attrs = $request->validate([
                'email' => 'required | email ',
                'password' => 'required | min: 6',
            ]);
    
          if(!Auth::attempt([$attrs])){
              return response (['message' => "Inalid credntials"],403);
    
            
        }
     //   $user = Auth::user();
        return response([
            'user'=> Auth::user(), 
            'token' => auth()->Auth::user()->createToken('secret')->plainTextToken
        
            ],200);


    }
    public function logout(){
        request()->user()->tokens()->delete();
        return response (['message' => "Logout success"],200);
    }
    public function user ()
    {
        return response([
            'user' => Auth::user()
        ],200);
    }
 
 
}
