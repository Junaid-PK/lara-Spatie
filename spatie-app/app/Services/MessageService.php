<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class MessageService
{
	// create message
	public function postMessage($validated)
	{
		$message = Message::create($validated);
		return $message;
	}	
} 