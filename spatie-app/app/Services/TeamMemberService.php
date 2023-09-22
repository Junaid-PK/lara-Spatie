<?php

namespace App\Services;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamMemberService
{
	public function add(array $data)
	{
		$teamMember = TeamMember::create([
			'team_id' => $data['team_id'],
			'user_id' => $data['user_id'],
		]);
		return $teamMember;
	}

	public function showTeam($team_id)
	{
		$teamMember = TeamMember::where('team_id', $team_id)->get();
		return $teamMember;
	}

	public function update($id, $data)
	{
		$teamMember = TeamMember::find($id);
		$teamMember->update([
			'user_id' => $data['user_id'],
			'team_id' => $data['team_id']
		]);
		return $teamMember;
	}
	public function delete($id)
	{
		$teamMember = TeamMember::find($id);
		$teamMember->delete();
		return $teamMember;
	}

	public function getTeamMember($id)
	{
		$teamMember = (TeamMember::find($id))?->first();
		return $teamMember;
	}
}
