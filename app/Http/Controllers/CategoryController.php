<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Photo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('category.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:500'
        ]);

        $code = Category::getUniqueVendorCode(Category::class);
	
		if ($request->hasFile('file')) {
			$folder = date('Y-m-d');
			$image_file_path = $request->file->store("images/categories/{$folder}", 'public');
		} else {
			$image_file_path = "images/categories/default.jpg";
		}
	
		$photo = Photo::create(
			[
				'path' => $image_file_path,
			]
		);
	
		$category = Category::create(array_merge($validatedData, compact('code')));
	
		$category->photos()->save($photo);

        return redirect()->route('categories.index')->with('status-create', 'Категория успешна добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        
        $products = $category->products()->paginate(12);
        
        $manufacturers = Manufacturer::all();
        
        return response()->view('category.show', compact('category', 'products', 'manufacturers'));
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
