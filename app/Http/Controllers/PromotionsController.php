<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    public function index()
	{
		$promotions = Promotion::all();
		
		return view('promotions.index', compact('promotions'));
	}
	
	public function create()
	{
		$promocode = Promotion::getPromoCode(Promotion::class);
		return response()->view('admin.promotion.create', compact('promocode'));
	}
	
	public function store(Request $request)
	{
		$validatedData = $request->validate([
			'promocode' => 'required',
			'discount' => 'required',
		]);
		
		if ($request->hasFile('file')) {
			$folder = date('Y-m-d');
			$image_file_path = $request->file->store("images/promotions/{$folder}", 'public');
		} else {
			$image_file_path = "images/promotions/default.jpg";
		}
		
		$photo = Photo::create(
			[
				'path' => $image_file_path,
			]
		);
		
		$promotion = Promotion::create($validatedData);
		
		$promotion->photos()->save($photo);
		
		return redirect()->route('promotions.index')->with('status-create', 'Промокод успешнo добавлен!');
	}
	
	public function show(Promotion $promotion)
	{
		return view('promotions.show', ['promotion' => $promotion]);
	}
}
