<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $products = Product::all();
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        $promotions = Promotion::all();

        return view('admin.index', compact('products','categories', 'manufacturers', 'promotions'));
    }
}
