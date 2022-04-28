<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
	public function index()
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
		
		if (auth()->check()) {
			$user_id = strval(auth()->user()->id);
		} else {
			$user_id = strval(0);
		}
		
		if (isset($_SESSION['basket'])) {
			$products_id = array();
			if (isset($_SESSION['basket'][$user_id])) {
			foreach ($_SESSION['basket'][$user_id] as $product) {
					array_push($products_id, intval($product['product_id']));
			}
			$products_in_basket = Product::find($products_id);
			}
		} else {
			$products_id = collect(array());
			$products_in_basket = collect(array());
		}
		
		if (isset($_SESSION['basket'][$user_id])) $products = $_SESSION['basket'][$user_id];
		else $products = array();
		
		return view('basket.index', compact('products_in_basket', 'products'));
	}
	
	public function store(Request $request)
	{
		$product = Product::find($request->product_id);
		$quantity = $request->quantity;
		
		session_start();
		
		if (auth()->check()) {
			$user_id = strval(auth()->user()->id);
		} else {
			$user_id = strval(0);
		}
		
		//initialize basket if not set or is unset
		if(!isset($_SESSION['basket'])){
			$_SESSION['basket'] = array();
		}
		if(!isset($_SESSION['basket'][$user_id])){
			$_SESSION['basket'][$user_id] = array();
		}
		
		//check if product is already in the cart
		if(!array_key_exists($request->product_id, $_SESSION['basket'][$user_id])){
			$_SESSION['basket'][$user_id][$request->product_id] = array(
				'product_id' => $request->product_id,
				'product_name' => $product->name,
				'price' => $product->price,
				'quantity' => $quantity,
			);
			
			$_SESSION['message'] = "Product with id=$request->product_id added to basket";
		}
		else{
			$_SESSION['message'] = "Product with id=$request->product_id already in basket";
		}
		
		$overall_count_basket = 0;
		
		foreach ($_SESSION['basket'][$user_id] as $product) {
			$overall_count_basket += intval($product['quantity']);
		}
		
		$_SESSION['overall_count_basket'] = $overall_count_basket;
		
		return response()->json(array(
			'message' => $_SESSION['message'],
			'products' => $_SESSION['basket'][$user_id],
			'overall_count_basket' => $_SESSION['overall_count_basket'],
		));
	}
	
	public function destroy(Request $request)
	{
		session_start();
		
		if (auth()->check()) {
			$user_id = strval(auth()->user()->id);
		} else {
			$user_id = strval(0);
		}
		
		$product_id = $request->product_id;
		
		//initialize basket if not set or is unset
		if(!isset($_SESSION['basket'])){
			$_SESSION['basket'] = array();
		}
		if(!isset($_SESSION['basket'][$user_id])){
			$_SESSION['basket'][$user_id] = array();
		}
		
		//check if product is already in the cart
		if(array_key_exists($product_id, $_SESSION['basket'][$user_id])){
			unset($_SESSION['basket'][$user_id][$product_id]);
			
			$_SESSION['message'] = "Product with id=$request->product_id removed from basket";
		}
		else{
			$_SESSION['message'] = "Product with id=$request->product_id doesn't exists in basket";
		}
		
		$overall_count_basket = 0;
		
		foreach ($_SESSION['basket'][$user_id] as $product) {
			$overall_count_basket += intval($product['quantity']);
		}
		
		$_SESSION['overall_count_basket'] = $overall_count_basket;
		
		return response()->json(array(
			'message' => $_SESSION['message'],
			'overall_count_basket' => $_SESSION['overall_count_basket'],
		));
	}
	
	public function get_already(Request $request)
	{
		session_start();
		
		if (auth()->check()) {
			$user_id = strval(auth()->user()->id);
		} else {
			$user_id = strval(0);
		}
		
		$products_id = array();
		
		//initialize basket if not set or is unset
		if(!isset($_SESSION['basket'])){
			$_SESSION['basket'] = array();
		}
		if(!isset($_SESSION['basket'][$user_id])){
			$_SESSION['basket'][$user_id] = array();
		}
		
		foreach ($_SESSION['basket'][$user_id] as $product) {
			array_push($products_id, $product['product_id']);
		}
		
		return response()->json(array(
				'products_id' => $products_id,
			)
		);
	}
	
	public function clear(Request $request)
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
		
		if (auth()->check()) {
			$user_id = strval(auth()->user()->id);
		} else {
			$user_id = strval(0);
		}
		
		//initialize basket if not set or is unset
		if(isset($_SESSION['basket'][$user_id])){
			unset($_SESSION['basket'][$user_id]);
		}
		if(isset($_SESSION['basket'])){
			unset($_SESSION['basket']);
		}
		if(isset($_SESSION['overall_count_basket'])){
			unset($_SESSION['overall_count_basket']);
		}
		
		return redirect()->back();
	}
}
