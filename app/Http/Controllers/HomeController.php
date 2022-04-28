<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
	{
		$promotions = Promotion::latest()->take(2)->get();
		
		return view('index', compact('promotions'));
	}
}
