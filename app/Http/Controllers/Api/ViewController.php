<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function viewHome(){
        return view('homePage');
    }
    public function viewLogin(){
        return view('auth.login');
    }
    public function viewRegister(){
        return view('auth.registerTeam');
    }
    public function viewUserDashboard($teamId){
        $teamInfo = Team::where('teamId', $teamId)->first();
        return view('user.userDashboard', compact('teamInfo'));
    }

    public function viewAdminLogin(){
        return view('admin.adminLogin');
    }
    public function viewAdminDashboard(){
        return redirect()->route('teamList');
    }
}