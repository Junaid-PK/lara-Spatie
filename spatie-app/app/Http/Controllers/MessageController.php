<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Message;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
	// postMessage
	public function postMessage(Request $request)
	{
		$message = $request->input('message');
		$teammember_id = $request->input('teammember_id');

		$message = Message::create([
			'message' => $message,
			'teammember_id' => $teammember_id,
		]);


		// get name of the user whose teammember_id is $teammember_id
		$teammember = TeamMember::where('id', $teammember_id)->first();

		broadcast(new MessageEvent($message, $teammember,))->toOthers();

		return ['status' => 'Message Sent!'];
	}
}