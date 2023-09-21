<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Http\Requests\Message\GetMessageRequest;
use App\Http\Requests\Message\PostMessageRequest;
use App\Models\Message;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use App\Services\MessageService;
use App\Services\TeamMemberService;
use App\Services\TeamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

	public function getLastMessages(GetMessageRequest $request, TeamService $teamService)
	{
		$validated = $request->validated();
		$team = $teamService->showTeam($validated['team_id']);
		if (!$team) {
			return response()->json([
				'message' => 'Team not found'
			], 404);
		}

		$rawQuery = 'SELECT m.id, m.message, m.teammember_id, m.created_at FROM messages m WHERE m.teammember_id IN (SELECT tm.id FROM teammembers tm WHERE tm.team_id = ' . $validated['team_id'] . ')';
		if (isset($validated['last_message_id'])) {
			$rawQuery .= ' AND m.id < ' . $validated['last_message_id'];
		}
		$rawQuery .= ' ORDER BY m.id DESC LIMIT 15';
		$messages = DB::select($rawQuery);

		return response()->json([
			'messages' => $messages
		], 200);
	}
}