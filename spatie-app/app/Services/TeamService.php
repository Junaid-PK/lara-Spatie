<?php

namespace App\Services;

use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;

class TeamService
{

	public function createTeam($data)
	{
		$name = $data['name'];
		$departmentId = $data['department_id'];
		$teamLeadId = $data['teamlead_id'];
		$team = Team::create([
			'name' => $name,
			'department_id' => $departmentId,
			'teamlead_id' => $teamLeadId,
		]);
		return $team;
	}


	public function getTeam()
	{
		$teams = Team::with('teammember')->paginate(15);
		return $teams;
	}

	public function userTeams()
	{
		$user = Auth::user();
		$teams = TeamMember::with('team')->where('user_id', $user->id)->get();
		return $teams;
	}
	public function showTeam($id)
	{
		$team = Team::find($id);
		return $team;
	}


	public function updateTeam($id, $data)
	{
		$team = Team::find($id);
		$team = $team->update([
			'name' => $data['name'],
			'department_id' => $data['department_id'],
			'teamlead_id' => $data['teamlead_id'],
		]);
		return $team;
	}


	public function deleteTeam($id)
	{
		$team = Team::find($id);
		$team = $team->delete();
		return $team;
	}


}