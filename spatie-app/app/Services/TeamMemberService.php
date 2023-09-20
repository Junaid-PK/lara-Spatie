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

    public function show_all()
    {
        $teamMembers = TeamMember::all();
        return $teamMembers;
       
    }

    public function showTeam($team_id)
    {
        $teamMember = TeamMember::where('team_id', $team_id)->get();

        return $teamMember;
       
    }

    public function update($user_id,$team_id, array $data)
    {
        $teamMember = TeamMember::where([['team_id', $team_id],['user_id',$user_id]])->first();
        
        $teamMember->update([
            'user_id' => $data['user_id'],
            'team_id' => $data['team_id']
        ]);
        return $teamMember;
       
    }

    public function delete($user_id,$team_id)
    {
        $teamMember = TeamMember::where([['team_id', $team_id],['user_id',$user_id]])->first();
        $teamMember=$teamMember->delete();
        return $teamMember;
        

    }
}