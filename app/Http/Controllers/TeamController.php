<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Models\usersData;
use App\Models\userTeam;
use Hash;
use Illuminate\Http\Request;

class TeamController extends Controller{
    public function createTeam(Request $request){
        // dd("Hello");
        $request->validate([
            'team_name' => 'required|max:255',
            'password' => 'required|string|max:255'
        ]);
        
        

        try{
            $team = Team::create([
                'team_name' => $request->team_name,
                'password' => Hash::make($request->password),
            ]);
            
            return view('auth.userInfoRegister')
    ->with([
        'success' => 'Register successful!',
        'teamId' => $team->id
    ]);
        }catch (\Exception $e){
            dd($e);
            return back()->withErrors('error', 'error occured, create team failed!');
        }
            
    }
    public function teamList(){
        $teams = Team::select('teamId', 'team_name',)->get();
        return view('admin.adminDashboard', compact('teams'));
    }
    public function teamListNumPage($num,$page){
        $perPage = $num;
        $totalTeams = Team::count();
        if ($page < 1 || $num < 1 || ($page - 1) * $perPage >= $totalTeams) {
            return response()->json(['success' => false, 'message' => 'Invalid page number or number of items per page'], 400);
        }
        $teams = Team::select('teamId', 'team_name')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();
        return response()->json(['success' => true, 'teams' => $teams], 200);
    }
    public function showTeamSortbyName($stat){
        
        $order = ($stat === 'asc') ? 'asc' : 'desc';
        $teams = Team::select('teamId', 'team_name')
                    ->orderBy('team_name', $order)
                    ->get();
                    return view('admin.adminDashboard', compact('teams'));
    }
    public function showTeamSortbyTime($stat){
        $order = $stat ? 'asc' : 'desc';
        $teams = Team::select('teamId', 'team_name')
                    ->orderBy('created_at', $order)
                    ->get();
        return view('admin.adminDashboard', compact('teams'));
    }
    public function searchByName($name){
    dd("KONTOL");
    $teams = Team::select('teamId', 'team_name')
                    ->where('team_name', 'like', $name . '%')
                    ->get();
        
        if ($teams->isEmpty()) {
            // Return the view with a message indicating teams not found
            return view('admin.adminDashboard', [
                'error' => 'Teams not found',
                'teams' => []
            ]);
        }

        // Return the view with the found teams
        return view('admin.adminDashboard', compact('teams'));
    }
    public function showTeamById($id){
        $team = Team::select('teamId', 'team_name')->where('teamId', $id)->first();
        if (!$team) {
            return response()->json(['success' => false, 'message' => 'Team not found'], 404);
        }
        return redirect()->route('dashboardView',['teamId'->$team->teamId]);
    }
    public function editTeam($id){
        $team = Team::where('teamId', $id)->first();
        if (!$team) {
            return response()->json(['success' => false, 'message' => 'Team not found'], 404);
        }
        $userTeam = userTeam::where('team_id', $team->teamId)        ->first();
        $userData = usersData::where('userId', $userTeam->user_id)->first();
        if (!$userTeam) {
            return response()->json(['success' => false, 'message' => 'User team not found'], 404);
        }
        if (!$userData) {
            return response()->json(['success' => false, 'message' => 'User data not found'], 404);
        }
        $userInfo = User::where('userId', $userTeam->user_id)->first();
        return view('admin.editTeam')->with(['team' => $team, 'userData' => $userData, 'userInfo' => $userInfo]);
    }

    public function updateTeam(Request $request, $id){
        $team = Team::find($id);
        if (!$team) {
            return response()->json(['success' => false, 'message' => 'Team not found'], 404);
        }

        $request->validate([
            'team_name' => 'required|max:255',
        ]);

        try {
            $team->update([
                'team_name' => $request->team_name,
            ]);
            return response()->json(['success' => true, 'message' => 'Team updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Update Team Failed'], 500);
        }
    }
    public function deleteTeam($id){
        $team = Team::where('teamId', $id)->first();
        if (!$team) {
            return response()->json(['success' => false, 'message' => 'Team not found'], 404);
        }

        try {
            $team->delete();
            return redirect()->back()->with('success', 'Team deleted successfully');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Delete Team Failed'], 500);
        }
    }
}