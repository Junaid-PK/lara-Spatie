<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;


use App\Models\Team;





class TeamController extends Controller
{
    public function store(TeamRequest $request, TeamService $teamService)
    {
        $validatedData = $request->validated();
        return $teamService->createTeam($validatedData);
    }


    public function index()
    {
        $teams = Team::all();
        return $teams;
    }

    public function show(Request $request, TeamService $teamService, $id)
    {
        return $teamService->getTeam($id);
    }


    public function update(Request $request, TeamService $teamService, $id)
    {
        //$validatedData = $request->validated();
        return $teamService->updateTeam($id, $request);
    }


    public function destroy(Request $request, TeamService $teamService, $id)
    {
        return $teamService->deleteTeam($id);
    }
}