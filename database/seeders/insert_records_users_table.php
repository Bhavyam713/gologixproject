<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class insert_records_users_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=[
        	[  "name"=>"bhavya",
        	   "email"=>"bhavya@gmail.com",
        	   "password"=>bcrypt('1234')
        	],
        	   
        	[  "name"=>"kavya",
        	   "email"=>"kavya@gmail.com",
        	   "password"=>bcrypt('5678')],
            ];
            User::insert($user);
    }
}
