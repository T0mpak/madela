<?php

namespace App\Http\Controllers;

use App\Mail\OrderMade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_mail_order_made()
	{
		$user = auth()->user();
		Mail::to('fake@mail.com')->send(new OrderMade($user));
		
		return view('dashboard');
	}
}
