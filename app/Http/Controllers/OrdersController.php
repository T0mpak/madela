<?php

namespace App\Http\Controllers;

use App\Mail\OrderMade;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function index()
	{
		if (auth()->check()) {
			$user = User::find(auth()->user()->id);
			$orders = $user->orders;
			if ($orders->count() == 0) {
				$orders = "You are either not authorized or don't have any orders! Please sign in, to check if you have any orders.";
			}
		} else {
			$orders = "You are either not authorized or don't have any orders! Please sign in, to check if you have any orders.";
		}
		
		return view('orders.index', compact('orders'));
	}
	
	public function store(Request $request)
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
		
		$data = $request->all();
		
		if (auth()->check()) {
			$user_id = strval(auth()->user()->id);
		} else {
			$user_id = strval(0);
		}
		if (auth()->check()) {
			$user_name = strval(auth()->user()->name);
		} else {
			$user_name = strval('guest');
		}
		
		if (isset($data['promocode'])) {
			$promotion = Promotion::where('promocode', '=', $data['promocode'])->first();
		}
		
		$products = $_SESSION['basket'][$user_id];
		
		$price = 0;
		
		foreach ($products as $product){
			$price += $product['price'] * $product['quantity'];
		}
		
		if (isset($data['promocode']) && isset($promotion)) {
			$price = $price - ($price * ($promotion->discount / 100));
		}
		
		$order = Order::create([
			'address' => $data['adress'],
			'telephone' => $data['telephone'],
			'email' => $data['email'],
			'customer_id' => $user_id,
			'customer_name' => $user_name,
			'price' => $price,
			'promotion_id' => (isset($promotion) ? $promotion->id : NULL),
		]);
		
		foreach ($products as $product){
			$order->products()->attach($product['product_id'], ['quantity' => $product['quantity']]);
		}
		
		unset($_SESSION['basket'][$user_id]);
		unset($_SESSION['basket']);
		unset($_SESSION['overall_count_basket']);
		
		if (auth()->check()) {
			$user = auth()->user();
			Mail::to($data['email'])->send(new OrderMade($user));
		}
		
		return redirect()->back()->with('success', 'Your order is successfully saved!');
	}
	
	public function get_discount_for_promocode(Request $request)
	{
		$promocode = Promotion::where('promocode', '=', $request->promocode)->firstOrFail();
		
		$discount = $promocode->discount;
		
		return response()->json(array(
			'discount' => $discount,
		));
	}
}
