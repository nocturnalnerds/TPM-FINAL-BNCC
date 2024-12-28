<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'team_name', 
        'random_key'
    ];
    public function users(){
        return $this->belongsToMany(User::class, 'user_team', 'team_id', 'user_id');
    }
}