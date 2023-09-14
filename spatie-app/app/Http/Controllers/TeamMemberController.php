<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;

class TeamMemberController extends Controller
{

    // index: Get a list of all team members.

    public function index()
    {
        $teamMembers = TeamMember::all();
        return response()->json (['data' => $teamMembers]);
    }

    // store: Create a new team member.

    public function store(Request $request)
    {

        $teamMember = TeamMember::create([
            'team_id' => $request->team_id,
            'user_id' => $request->user_id,
        ]);

        if(! $teamMember){
            return response()->json([
                'message' => 'Failed to add Team Member'
            ]);
        }
        return response()->json([
            'message' => 'Team Member Created successfully'
        ]);
    }


    public function show(Request $request)
    {
        $id = $request->teammember_id;
        $teamMember = TeamMember::where('user_id', $id)->get();

        if (!$teamMember) {
            return response()->json(['error' => 'Team member not found'], 404);
        }

        return response()->json(['data' => $teamMember]);
    }

    public function destroy(Request $request)
    {
        $teamMember = TeamMember::find($request->teammember_id);
        if (!$teamMember) {
            return response()->json(['error' => 'Team member not found'], 404);
        }
        $teamMember->delete();
        return response()->json(['message' => 'Team member deleted successfully']);
    }
}