<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class useraddress extends Model
{
    use HasFactory;

    public function User()
    {
    	// return $this->belongsTo("App\Models\User",'id','user_id');

    	 return $this->belongsTo(User::class);
    }
}
