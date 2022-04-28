<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = Product::all();
    	$manufacturers = Manufacturer::all();
    	$categories = Category::all();
        return response()->view('product.products', compact('products', 'manufacturers', 'categories'), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = Category::all();
    	$manufacturers = Manufacturer::all();
    	
        return response()->view('admin.product.create', compact('categories', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validatedData = $request->validate([
			'name' => 'required|max:100',
			'description' => 'required|max:500',
			'category_id' => 'required',
			'manufacturer_id' => 'required',
			'price' => 'required',
		]);
	
		if ($request->hasFile('file')) {
			$folder = date('Y-m-d');
			$image_file_path = $request->file->store("images/products/{$folder}", 'public');
		} else {
			$image_file_path = "images/products/default.jpg";
		}
		
		$photo = Photo::create(
			[
				'path' => $image_file_path,
			]
		);
	
		$code = Product::getUniqueVendorCode(Product::class, $validatedData['category_id'], $validatedData['manufacturer_id'], $validatedData['name']);
	
		$product = Product::create(array_merge($validatedData, compact('code')));
		
		$product->photos()->save($photo);
		
		return redirect()->route('products.index')->with('status-create', 'Продукт успешнo добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
