<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userTeam extends Model
{
    protected $table = 'user_team';
    protected $fillable = [
        'user_id',
        'team_id',
    ];
}