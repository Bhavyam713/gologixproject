<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Api\LoginController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 // GET  secure API to get data from database

Route::get("getuser", 'App\Http\Controllers\ApiController@getdata');


//  secure GET API to get data from database

// Route::get("getuser_list", 'App\Http\Controllers\ApiController@getdatasecure'); 


 //POST API to store data into database with api token
Route::post("adduser", 'App\Http\Controllers\ApiController@adddata');

//POST API to store data into database with api token
// Route::post("adduser_token", 'App\Http\Controllers\ApiController@adddata_token');

// POst api to log in the user


 // Route::post("login", 'App\Http\Controllers\Api\LoginController@login');

  Route::post("login", 'App\Http\Controllers\ApiController@login');


//PUT API to update data into database
Route::put("updateuser",'App\Http\Controllers\ApiController@updatedata');


//DELETE API to delete data from database single user
Route::delete("deleteuser/{id}",'App\Http\Controllers\ApiController@deletedata');



 //POST API to store address into database with api token
Route::post("addaddress/{id}", 'App\Http\Controllers\ApiController@addaddress');

//Get api to get the all the addresses of user by using user_id

Route::get('getaddresses/{id}','App\Http\Controllers\ApiController@getaddress');

