<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
use App\Models\Product_discount;
use App\Models\Product_inventatory;

class product extends Model
{
    use HasFactory;

    public function category()
    {
    	return $this->belongsTo(category::class);
    }

    public function Product_discount()
    {
    	return $this->belongsTo(Product_discount::class);
    }

    public function Product_inventatory()
    {
    	return $this->belongsTo(Product_inventatory::class);
    }
}
