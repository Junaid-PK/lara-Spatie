<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Services\TeamService;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends Controller
{
    public function postTeam(TeamRequest $request, TeamService $teamService)
    {
        $validatedData = $request->validated();
        $team= $teamService->createTeam($validatedData);
        if(!$team){
            return response()->json([
                'message' => 'Failed to create a new Team',
            ]);
        }
        return response()->json([
            'message' => 'Team Created Successfully',
            'data' => $team
        ],200);
    }


    public function getTeams(TeamService $teamService)
    {
        $teams= $teamService->getTeam();
        return response()->json([
            'message' => 'success',
            'data' => $teams,
        ],200);
    }
    public function getUserTeams(TeamService $teamService)
    {
        $teams= $teamService->userTeams();
        
      
        return response()->json([
            'message' => 'success',
            'data' => $teams,
        ],200);
       
    }

    public function showTeams(TeamService $teamService, $id)
    {
        $team= $teamService->showTeam($id);
        if (!$team) {
            return response()->json([
                'message' => 'Team not found'
            ], 404);
        }
        return response()->json([
            'message' => 'Team Found',
            'data' => $team,
        ]);
    }


    public function updateTeams(UpdateTeamRequest $request, TeamService $teamService, $id)
    {
        $data = $request->validated();
        $team= $teamService->updateTeam($id, $data);
        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }else{
            return response()->json(['message' => 'Team updated successfully']);
        }
    }


    public function deleteTeams(TeamService $teamService, $id)
    {
        $team=$teamService->deleteTeam($id);
        if (!$team) {
            return response()->json(['error' => 'Team not found'], 404);
        }
        else{
            return response()->json(['message' => 'Team deleted successfully'],200);
        }
    }
}