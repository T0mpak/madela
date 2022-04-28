<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user)
	{
		if ($user->id !== auth()->user()->id)
		{
			abort(403);
		}
		
		if (auth()->check()) {
			$user = User::find($user->id);
			$orders = $user->orders;
			if ($orders->count() == 0) {
				$orders = "You don't have any orders!";
			}
		} else {
			$orders = "You don't have any orders!";
		}
		
		return view('users.index', compact('user', 'orders'));
	}
	
	public function cancel(Request $request)
	{
		$order_id = $request->order_id;
		
		$order = Order::find($order_id);
		
		if ($order->is_aprroved == 1 or $order->is_finished == 1) {
			return redirect()->back()->with('success', "You can't cancel approved(or even finished) order! Order with id => $order_id is already approved(or finished)!");
		}
		$order->is_canceled = 1;
		
		$order->save();
		
		return redirect()->back()->with('success', "Order with id => $order_id is successfully canceled!");
	}
	
	public function finish(Request $request)
	{
		$order_id = $request->order_id;
		
		$order = Order::find($order_id);
		
		$order->is_finished = 1;
		
		$order->save();
		
		return redirect()->back()->with('success', "Order with id => $order_id is successfully finished!");
	}
}
