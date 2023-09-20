<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	use HasFactory;

	protected $fillable = [
		'message',
		'teammember_id',
	];

	public function teammember()
	{
		return $this->belongsTo(TeamMember::class);
	}
}
