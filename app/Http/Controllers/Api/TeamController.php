<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller{
    public function createTeam(Request $request){
        $request->validate([
            'team_name' => 'required|max:255',
        ]);
        $code = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        while (Team::where('code', $code)->exists()) {
            $code = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        }
        
        try{
            $team = Team::create([
                'team_name' => $request->team_name,
                'random_key' => $code,
            ]);
            return response()->json(["message" => "Team \'$team->team_name\' Successfully Created"],200);
        }catch (\Exception $e){
            dd($e);
            return response()->json(["message" => "Create Team Failed"], 500);
        }
            
    }
    public function teamList(){
        $teams = Team::all();
        $teams = Team::select('teamId', 'team_name',)->get();
        return response()->json(['success' => true, 'teams' => $teams], 200);
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
        
        $order = $stat ? 'asc' : 'desc';
        $teams = Team::select('teamId', 'team_name')
                    ->orderBy('name', $order)
                    ->get();
        return response()->json(['success' => true, 'teams' => $teams], 200);
    }
    public function showTeamSortbyTime($stat){
        $order = $stat ? 'asc' : 'desc';
        $teams = Team::select('teamId', 'team_name')
                    ->orderBy('created_at', $order)
                    ->get();
        return response()->json(['success' => true, 'teams' => $teams], 200);
    }
    public function searchByName($name){
        
        $teams = Team::select('teamId', 'team_name')
                    ->where('team_name', 'like', $name . '%')
                    ->get();
        return response()->json(['success' => true, 'teams' => $teams], 200);
    }
    public function editTeam($id){
        $team = Team::find($id);
        if (!$team) {
            return response()->json(['success' => false, 'message' => 'Team not found'], 404);
        }
        return response()->json(['success' => true, 'team' => $team], 200);
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
        $team = Team::find($id);
        if (!$team) {
            return response()->json(['success' => false, 'message' => 'Team not found'], 404);
        }

        try {
            $team->delete();
            return response()->json(['success' => true, 'message' => 'Team deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Delete Team Failed'], 500);
        }
    }
}