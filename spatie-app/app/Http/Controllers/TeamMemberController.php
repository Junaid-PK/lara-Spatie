<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTeamMemberRequest;
use App\Services\TeamMemberService;

class TeamMemberController extends Controller
{

    public function getAllTeamMembers(TeamMemberService $teamMemberService)
    {
        $teamMembers=$teamMemberService->show_all();
        return response()->json ([
            'message' => "All Teams along with their members",
            'data' => $teamMembers
        ], 200);
    }

    public function postTeamMembers(CreateTeamMemberRequest $request, TeamMemberService $teamMemberService)
    {
        $validate=$request->validated();
        $teamMember=$teamMemberService->add($validate);
        if(! $teamMember){
            return response()->json([
                'message' => 'Failed to add Team Member'
            ]);
        }
        return response()->json([
            'message' => 'Team Member added successfully'
        ], 200);
    }

    public function getTeamMember($team_id, TeamMemberService $teamMemberService)
    {
        $teamMember=$teamMemberService->showTeam($team_id);
        if (! $teamMember) {
            return response()->json([
                'message' => 'Team doest not exist'
            ], 404);
        }
    
        return response()->json([
            'message' => 'Team Found',
            'data' => $teamMember
        ], 200);
    }

    public function updateTeamMember($user_id,$team_id, CreateTeamMemberRequest $request, TeamMemberService $teamMemberService)
    {
        $validate=$request->validated();
        $teamMember=$teamMemberService->update($user_id,$team_id, $validate);
        if(!$teamMember)
        {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        return response()->json([
            'message' => 'Team Member Successfully Updated',
            'data' => $teamMember
        ], 200);

    }

    public function deleteTeamMember($user_id,$team_id, TeamMemberService $teamMemberService)
    {
        $teamMember=$teamMemberService->delete($user_id,$team_id);
        if(! $teamMember)
        {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        return response()->json([
            'message' => 'Team Member Successfully Deleted',
        ], 200);
        
        // $id = $teamMember->id;
        // TeamMember::where('id', $id)->delete();

    }
}