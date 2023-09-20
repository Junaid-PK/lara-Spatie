<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    use HasFactory;
    protected $fillable = ['name','department_id', 'teamlead_id'];
}
