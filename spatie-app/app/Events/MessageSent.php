<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use \App\Models\User;
use \App\Models\Message;

class MessageSent implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $user;
	public $message;

	/**
	 * Create a new event instance.
	 */
	public function __construct(User $user, Message $message)
	{
		$this->user = $user;
		$this->message = $message;
	}


	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return array<int, \Illuminate\Broadcasting\Channel>
	 */

	// channel to broadcast to
	public function broadcastOn(): array
	{
		// broadcast to the team channel
		// error_log(print_r($this->user, true));
		return [
			// new PrivateChannel($this->user->team->id),
			new PrivateChannel('channelName'),
		];
	}

	// listen to this specific event on the front end
	public function BroadcastAs()
	{
		// listen to this event on the front end
		return 'MessageSent';
	}

	// data to send to the front end
	public function broadcastWith()
	{
		// data to send to the front end
		return [
			'message' => $this->message->message,
			'user' => [
				'name' => $this->user->name,
				'avatar' => 'https://www.gravatar.com/avatar/' . md5($this->user->email),
			],
		];
	}
}
