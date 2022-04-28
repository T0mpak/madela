<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index(Request $request)
    {
        $request->validate(['s' => 'required',]);
        $s = $request->s;
        $products = Product::where('name', 'LIKE', "%{$s}%")->paginate(4);
        return view('product.search', compact('products', 's'));
    }

}
