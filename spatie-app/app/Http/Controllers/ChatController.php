<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
// use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

use \App\Events\MessageSent;

class ChatsController extends Controller
{
	public function fetchMessages()
	{
		return Message::with('user')->get();
	}

	public function sendMessage(Request $request)
	{
		$user = $request->user();
		// error_log($user);
		$message = $user->messages()->create([
			'message' => $request->input('message')
		]);

		broadcast(new MessageSent($user, $message))->toOthers();

		return ['status' => 'Message Sent!'];
	}
}
