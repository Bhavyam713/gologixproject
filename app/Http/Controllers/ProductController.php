<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    //get all the product
    public function getproduct()
    {
      $product=Product::get();
      return response()->json(["$product"=>$product]);
    }

    // add the products to table
    public function addproduct($id,Request $req)
    {
       $cat=Category::find($id);
       $addproduct=new Product();
       $addproduct->name=$req->name;
       $addproduct->description	=$req->description;
       $cat-> products()->save($addproduct);


       $msg="Products added successfully";
       return response()->json(["msg"=>$msg]);
    }

    //get products according to category id
    public function getproductbycategory($id)
    {
    	$products[]=Category::find($id)->products;
        foreach ( $products as $product) 
       {
      return $product;
       # code...
       }
    }
}
