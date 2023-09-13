<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'teammembers';
    use HasFactory;
    protected $fillable = ['name','department_id', 'teamlead_id'];
}
