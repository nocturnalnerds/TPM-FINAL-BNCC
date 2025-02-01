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
            
            return view('auth.userInfoRegister')->with(['success' => 'Register successful!', 'teamId' => $team->teamId]);            
        }catch (\Exception $e){
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
        $userInfo = User::select('userId', 'name', 'email')->where('userId', $userTeam->user_id)->first();
        return view('admin.editTeam')->with(['team' => $team, 'userData' => $userData, 'userInfo' => $userInfo]);
    }

    public function updateTeam(Request $request, $id){
        

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'line_id' => 'nullable|string|max:50',
            'github_gitlab_id' => 'nullable|string|max:50',
            'birthplace' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'cv' => 'nullable|file|mimes:pdf',
            'flazz_or_id' => 'nullable|file|mimes:png,jpg',
        ]);
        // Find the team by its ID
        $team = Team::where('teamId', $id)->first();
        // dd($request->all(),$team, $id);
        if (!$team) {
            return response()->json(['success' => false, 'message' => 'Team not found'], 404);
        }
    
        // Find the associated userTeam and userData
        $userTeam = userTeam::where('team_id', $team->teamId)->first();
        $userData = usersData::where('userId', $userTeam->user_id)->first();
        if (!$userTeam || !$userData) {
            return response()->json(['success' => false, 'message' => 'User team or user data not found'], 404);
        }
    
        // Update the user data
        $userData->whatsapp_number = $request->input('whatsapp_number');
        $userData->line_id = $request->input('line_id');
        $userData->github_gitlab_id = $request->input('github_gitlab_id');
        $userData->birthplace = $request->input('birthplace');
        $userData->birthdate = $request->input('birthdate');
    
        // Handle file uploads if they exist
        if ($request->hasFile('cv')) {
            $filePath = public_path('storage/cv');
            $file = $request->file(key: 'cv');
            $cv_fileName = "{$team->team_name}-CV." . $file->getClientOriginalExtension();
            $file->move($filePath, $cv_fileName);
            $cv_final_fileName = "storage/cv/{$cv_fileName}";
            $userData->cv_path = $cv_final_fileName;
        }
        
        
        
        
        
        if ($request->hasFile('flazz')) {
            $filePath = public_path('storage/flazz_or_id');
            $file = $request->file(key: 'flazz_or_id');
            $flazz_or_id_fileName = "{$request->group_name}-flazz_or_id" . $file->getClientOriginalExtension();
            $file->move($filePath, $flazz_or_id_fileName);
            $flazz_or_id_final_fileName = "storage/flazz_or_id/{$flazz_or_id_fileName}";
            $userData->flazz_or_id_card_path = $flazz_or_id_final_fileName;
        }
    
        // dd($userData);
        // Save the updated user data
        $userData->save();
    
        // Optionally update user info if needed (e.g. update email or name)
        $userInfo = User::where('userId', $userTeam->user_id)->first();
        if ($userInfo) {
            $userInfo->name = $request->input('name', $userInfo->name);
            $userInfo->email = $request->input('email', $userInfo->email);
            $userInfo->save();
        }
        
        
        // Redirect back or return a success response
        return redirect()->route('teamList')->with('success', 'Team updated successfully!');
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