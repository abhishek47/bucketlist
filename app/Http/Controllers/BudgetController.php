<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BudgetController extends Controller
{

	public function index()
	{
		return view('products.budget');
	}

    public function set()
    {
	session(['budget' => request('budget')]);

    	return redirect('/categories/choose');

    }
}
