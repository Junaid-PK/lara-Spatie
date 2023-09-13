<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'team_members';
    use HasFactory;
    protected $fillable = ['Team_ID', 'User_ID'];

}
