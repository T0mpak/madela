<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
	public function filter(Request $request)
	{
		$price_min = $request->price_min ?? 0;
		$price_max = $request->price_max ?? 9999999;
		$manufacturers_id_for_filter = $request->manufacturers ?? Manufacturer::get_arrayOfIDs_from_collection(Manufacturer::all('id'));
		$category_id_for_filter = [];
		if(isset($request->category)) {
			array_push($category_id_for_filter, $request->category);
		} else {
			$category_id_for_filter = Manufacturer::get_arrayOfIDs_from_collection(Category::all('id'));
		}
		
		$products = Product::whereIn('category_id', $category_id_for_filter)->where('price', '>=', "$price_min")->where('price', '<=', "$price_max")->whereIn('manufacturer_id', $manufacturers_id_for_filter)->get();
		$manufacturers = Manufacturer::all();
		$categories = Category::all();
		
		$old_values = array();
		$old_values['price_min'] = $request->price_min;
		$old_values['price_max'] = $request->price_max;
		$old_values['manufacturers'] = $request->manufacturers;
		$old_values['category'] = $request->category;
		
		return response()->view('product.products', compact('products', 'manufacturers', 'categories', 'old_values'));
	}
}
