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


    	$all_products = [];

    	foreach ($categories as $key => $category) {
    		$products = Product::where('category_id', $category->id)->whereHas('options',function ($query) use ($options, $category) {
    					
						    $query->where('options.id', $options[$category->id]);
						})->with('options')->get();

            $all_products[$category->id] = $products;
    	}


        $combinations = [];

        dd($this->combinations($all_products));



    	$carts = [];



    	return view('cart.choices', compact('carts'));
    }

    private function combinations($arrays, $i = 0) {
    if (!isset($arrays[$i])) {
        return array();
    }
    if ($i == count($arrays) - 1) {
        return $arrays[$i];
    }

    // get combinations from subsequent arrays
    $tmp = combinations($arrays, $i + 1);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as $v) {
        foreach ($tmp as $t) {
            $result[] = is_array($t) ? 
                array_merge(array($v), $t) :
                array($v, $t);
        }
    }

    return 100;

    return $result;
}

}
