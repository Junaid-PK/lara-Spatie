<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;

class TeamController extends Controller
{
    public function store(TeamRequest $request, TeamService $teamService)
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
        ],200);
    }


    public function index(TeamService $teamService)
    {
        $teams= $teamService->getTeam();
        return response()->json([
            'message' => 'success',
            'data' => $teams,
        ],200);
       
    }

    public function show(Request $request, TeamService $teamService, $id)
    {
        $team= $teamService->showTeam($id);
        if (!$team) {
            return response()->json([
                'message' => 'Team not found'
            ], 404);
        }
        return response()->json(['data' => $team]);
    }


    public function update(Request $request, TeamService $teamService, $id)
    {
        //$validatedData = $request->validated();
        $team= $teamService->updateTeam($id, $request);
        if (!$team) {
            return response()->json(['error' => 'Team not found'], 404);
        }else{
            return response()->json(['message' => 'Team updated successfully', 'data' => $team]);
        }
    }


    public function destroy(Request $request, TeamService $teamService, $id)
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