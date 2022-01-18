<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\useraddress;
use Validator;

class ApiController extends Controller
{
  
// to add address to database
    public function addaddress($id,Request $req)
    {
      $user=User::find($id);
      $userdata=new useraddress();
      // $userdata->user_id=$req->user_id;
      $userdata->address_line1=$req->address_line1;
      $userdata->address_line2=$req->address_line2;
      $userdata->city=$req->city;
      $userdata->landmark=$req->landmark;
      $userdata->postal_code=$req->postal_code;
      $userdata->country=$req->country;
      $user->useraddresses()->save($userdata);

      $msg="Address Successfully Added";

      return response()->json(['message'=>$msg]);
    }


   // api for login
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
        if($req->password == $userpassword->password)
        {
          $msg=$req->email;
        return response()->json(["message"=>$msg]);
        }
        else{
          $msg1="Incorrect data";
        return response()->json(["message"=>$msg1]);
        }
      }
    
    }


//aunthiticate the user n to display all the date
    public function getdata(Request $req)
    {  
        echo "test";
       /*$header=$req->header('Authorization');
       if(empty($header))
       {
         $msg1="Authuntication fails";
         return response()->json(["status"=>false,"message"=>$msg1,422]);
       }
       else
       { 
        if($header=="123456")
        {*/
         $user=User::get();
         return response()->json(["$user"=>$user]);
       /* }
        else{
          $msg2="Authuntication fails";
         return response()->json(["status"=>false,"message"=>$msg2,422]);
        }
       }*/


    }

    public function getdatasecure(Request $req)
    {
       $header=$req->header('Authorization');
       if(empty($header))
       {
         $msg1="Authuntication fails";
         return response()->json(["status"=>falses,"message"=>$msg1,422]);
       }
       else
       { 
        if($header="123456")
        {
         $user=User::get();
         return response()->json(["$user"=>$user]);
        }
        else{
          $msg1="Authuntication fails";
         return response()->json(["status"=>falses,"message"=>$msg1,422]);
        }
       }

    }
 // Api to get all the addresses of user
    public function getaddress($id)
    {
     $useraddresses[]=User::find($id)->useraddresses;
     foreach ( $useraddresses as $address) 
     {
      return $address;
       # code...
     }
    }


// $arrayName = array('' => , );









 // user registration with api_token

   public function adddata(Request $req)
    {
       if($req->isMethod('post'))
       {
         $adddata=$req->input();
          $api_token=Str::random(60);

/* simple validations

        // to check  all entries are entried user 
       if(empty($adddata['name'])||empty($adddata['email'])||empty($adddata['password']))
       {
        $message="Please fill all the details";
        return response()->json(["status"=>false,"message"=>$message],422);
       }

       //to check mail validation
       if (filter_var(($adddata['email']), FILTER_VALIDATE_EMAIL)) {


            //echo("$email is a valid email address");
       } else {
        $message1= "email is not a valid email address";
        return response()->json(["status"=>false,"message"=>$message1],422);
       }

          //to check user email exists
       $emailexit=User::where('email','=',($adddata['email']))->exists();
       if ($emailexit) {
           # code...
        $message2= "Already registered mail id..Please enter new email id";
        return response()->json(["status"=>false,"message"=>$message2],422);
       }*/

       //Advance post API validation
     $rules=[ "name"=>"required",
              "email"=>"required|email|unique:users",
              "password"=>"required",
              "phonenum"=>"required|unique:users"
     ];

     $customMessages=[ "name.required"=>"Name is required",
              "email.required"=>"Email is required",
              "email.email"=>"Valid email is required",
              "email.unique"=>"Email id Already exists",
              "password.required"=>"Password required",
              "phonenum.required"=>"Phone number required"
     ];


     $validator=Validator::make($adddata,$rules,$customMessages);
     if($validator->fails())
     {
      return response()->json([$validator->errors(),422]);
     }

      else{

         $addtodatabase=new User;
        $addtodatabase->name=$req->name;
        $addtodatabase->email=$req->email;
        $addtodatabase->password=$req->password;
        $addtodatabase->phonenum=$req->phonenum;
        $addtodatabase->api_token=$api_token;
        $addtodatabase->save();
        $msg= "Thanks for registering with us";
         // useraddress::where()->update('user_id','$addtodatabase->id');
        return response()->json(["message"=>$msg]);
        }
    }

  } 
// user registeration with api token
    public function adddata_token(Request $req)
    { 
      if($req->isMethod('post'))
      {
        $api_token=Str::random(60);
        $user=new User;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=$req->password;
        $user->api_token=$api_token;
        $user->save();

        $msg= "Thanks for registering with us";
         
        return response()->json([ "status"=>"true","message"=>$msg,200]);

      }

    }




















       
    public function updatedata($id,Request $req)
    {
       if($req->isMethod('put'))
      {
        // $userdata=$req->input();
        // User::where('id',$userdata['id'])->Update(['name'=>$userdata['name'],'email'=>$userdata['email'],'password'=>$userdata['password']]);

       // $updated= User::where('id',$req->id)->Update(['name'=>$req->name,'email'=>$req->email,'password'=>$req->password,'phonenum'=>$req->phonenum]);
       $updated=User::find($id);
       $updated->name=$req->name;
       $updated->email=$req->email;
       $updated->password=$req->password;
       $updated->phonenum=$req->phonenum;
       $updated->push();


       if($updated) 
        {
         return response()->json(["message"=>" User details Updated successfully"]);
        }
       else
        {
          return response()->json(["message"=>" User details  failed to Update"]);
        }
      }
    } 


    public function deletedata($id)
    {
        User::where('id',$id)->delete();
        return response()->json(["message"=>"User deleted account"]);
    } 
   
       
     


    






        

       
    
}
