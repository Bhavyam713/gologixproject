<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class product_inventatory extends Model
{
    use HasFactory;
    
    public function Products()
    {
    	return $this->hasMany(Product::class);
    }
}
