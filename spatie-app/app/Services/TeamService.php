<?php

namespace App\Services;

use App\Models\Team;

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
		$teams = Team::all();
		return $teams;
	}
	public function showTeam($id)
	{
		$team = Team::find($id);
		return $team;
	}


	// public function updateTeam($id, $data)
	// {
	//     $team = Team::find($id);
	//     if (!$team) {
	//         return response()->json(['error' => 'Team not found'], 404);
	//     }
	//     $team->update
	//     ([
	//         'name' => empty($data->name) ? $team->name : $data->name,
	//         'department_id' => empty($data->department_id) ? $team->department_id : $data->department_id,
	//         'teamlead_id' => empty($data->teamlead_id) ? $team->teamlead_id : $data->teamlead_id,
	//     ]);
	//     return response()->json(['message' => 'Team updated successfully', 'data' => $team]);
	// }


	public function updateTeam($id, $data)
	{
		$team = Team::find($id);

		$team = $team->update([
			'name' => ($data['name']) ? $data['name'] : $team->name,
			'department_id' => ($data['department_id']) ? $team->department_id : $data['department_id'],
			'teamlead_id' => ($data['teamlead_id']) ? $team->teamlead_id : $data['teamlead_id'],
		]);
		return $team;
	}


	public function deleteTeam($id)
	{
		$team = Team::find($id);
		$team = $team->delete();
		return $team;
	}

	// get user teams
	public function getUserTeams($user_id)
	{
		$teams = Team::where('teamlead_id', $user_id)->get();
		return $teams;
	}
}
