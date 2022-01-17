<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\User;
use Validator;


class LoginController extends Controller
{






 public function login(Request $req)
    {
      $userdata=$req->input();

         //Advance post API validation
     $rules=[ 
              "email"=>"required|email|exists:users",
              "password"=>"required"
     ];

     $customMessages=[ 
              "email.required"=>"Email is required",
              "email.email"=>"Valid email is required",
              "email.unique"=>"Email id Already exists",
              "password.required"=>"Password required"
     ];


     $validator=Validator::make($userdata,$rules,$customMessages);
     if($validator->fails())
     {
      return response()->json($validator->errors(),422);
     }

      else
      {

        $useemail=$req->email;
        $userpassword=User::where('email',$useemail)->first();
        if(password_verify($req->password,$userpassword->password))
        {
          $login="Successfully logged in";
          return response()->json(['message'=>$login]);
        }
      }
    
    }

}
