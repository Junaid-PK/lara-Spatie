<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Http\Requests\Message\PostMessageRequest;
use App\Models\Message;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use App\Services\MessageService;
use App\Services\TeamMemberService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
	// postMessage
	public function postMessage(PostMessageRequest $request, MessageService $messageService, TeamMemberService $teamMemberService)
	{
		$validated = $request->validated();
		$teamMember = $teamMemberService->getTeamMember($validated['teammember_id']);
		if (!$teamMember) {
			return response()->json([
				'message' => 'Team Member not found'
			], 404);
		}
		$message = $messageService->postMessage($validated);

		broadcast(new MessageEvent($message, $teamMember,))->toOthers();
		return ['status' => 'Message Sent Successfully'];
	}

	public function getMessages()
	{
		// 
	}
}
