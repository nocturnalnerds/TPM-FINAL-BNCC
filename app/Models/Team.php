<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Team extends Authenticatable{
    use HasApiTokens, Notifiable;
    protected $primaryKey = 'teamId'; // Define the actual primary key
    protected $fillable = ['team_name', 'password'];  // Ensure team_name and password are fillable

}