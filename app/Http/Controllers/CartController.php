<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
    	$budget = session('budget');

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

            $all_products[] = $products;
    	}


        $carts = [];

        $combinations = $this->combinations($all_products);


        foreach ($combinations as $key => $combination) {
            $cart = [];

            $cart['items'] = $combination;
            $cart['total'] = 0;
            $cart['total_profit'] = 0;
            $cart['rating'] = 0;

            foreach ($combination as $key => $product) {
                $cart['total'] = $cart['total'] + $product->price;
                $cart['total_profit'] = $cart['total_profit'] + ($product->price - $product->cost_price);
                $cart['rating'] = $cart['rating'] + $product->rating;
            }

            if($cart['total'] <= $budget)
            {
                if((count($cart['items']) == count($catIds)) || ( (($budget - $cart['total']) == 0) || (($budget - $cart['total']) >= $budget * (50/100))))
                {
                    $cart['total_profit'] = $cart['total_profit'] / count($cart['items']);
                    $cart['rating'] = $cart['rating'] / count($cart['items']);
                    $cart['rank_value'] = $cart['total_profit'] / $cart['rating'];
                    $carts[] = $cart;
                }
            }

        }






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
    $tmp = $this->combinations($arrays, $i + 1);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as $v) {
        foreach ($tmp as $t) {
            $result[] = is_array($t) ? 
                array_merge(array($v), $t) :
                array($v, $t);
        }
    }


    return $result;
}

}
