<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
    	
    	$catIds = session('categories');
    	
    	$categories = [];

    	foreach ($catIds as $key => $cat) {
    		$categories[] = Category::findOrFail($cat);
    	}		

    	$options = [];

    	foreach ($categories as $key => $category) {
    		$options[$category->id] = request('options_' . $category->id);
    	}


    	$products = [];

    	foreach ($categories as $key => $category) {
    		$products = Product::where('category_id', $category->id)->whereHas('options',function ($query) use ($options, $category) {
    					
						    $query->where('options.id', $options[$category->id]);
						})->with('options')->get();
    	}


    	dd($products);


    	$carts = [];



    	return view('cart.choices', compact('carts'));
    }
}
