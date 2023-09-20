<?php

namespace App\Events;

use App\Models\Message;
use App\Models\TeamMember;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Helpers\Constants\MessageConstant;

class MessageEvent implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $message;
	public $teammember;
	/**
	 * Create a new event instance.
	 */
	public function __construct(Message $message, TeamMember $teammember)
	{
		$this->message = $message;
		$this->teammember = $teammember;
	}

	/**
	 * Get the channels the event should broadcast on.
	 */
	public function broadcastOn()
	{
		return new PrivateChannel('team.' . $this->teammember->team_id);
	}

	public function broadcastAs()
	{
		return MessageConstant::TEAM_MESSAGE_SENT_EVENT;
	}
}
