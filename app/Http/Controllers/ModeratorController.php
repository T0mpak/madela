<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use function Symfony\Component\Mime\Header\get;

class ModeratorController extends Controller
{
    public function index()
	{
		return view('admin.moderator.index');
	}
	
	
	public function unapproved()
	{
		$unapproved_orders = Order::where('is_approved', '=', '0')->where('is_canceled', '=', '0')->get();
		if ($unapproved_orders->count() == 0) {
			$unapproved_orders = "There are no unapproved orders!";
		}
		
		return view('admin.moderator.unapproved', compact('unapproved_orders'));
	}
	
	public function approve(Request $request)
	{
		$order_id = $request->order_id;
		
		$order = Order::find($order_id);
		
		if ($order->is_canceled == 1) {
			return redirect()->back()->with('fail', "Order with id => $order_id is canceled! You can't approve it anymore!");
		}
		$order->is_approved = 1;
		
		$order->save();
		
		return redirect()->back()->with('success', "Order with id => $order_id is successfully approved!");
	}
	
	public function unfinished()
	{
		$unfinished_orders = Order::where('is_finished', '=', '0')->where('is_canceled', '=', '0')->where('is_approved', '=', '1')->get();
		if ($unfinished_orders->count() == 0) {
			$unfinished_orders = "There are no unfinished orders!";
		}
		
		return view('admin.moderator.unfinished', compact('unfinished_orders'));
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
