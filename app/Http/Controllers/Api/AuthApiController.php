<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Team;
use App\Models\User;
use App\Models\usersData;
use App\Models\userTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller{
    public function register(Request $request){
        $request->validate([
            "name" => "required|string|max:255",
            "password" => "required|string|max:255",
            "email" => "required|string|max:255",
            "whatsapp_number" => "required|string|max:255",
            "line_id" => "required|string|max:255",
            "github_gitlab_id" => "required|string|max:255",
            "birthplace" => "required|string|max:255",
            "birthdate" => "required|string|max:255",
            "cv" => "required|mimes:pdf|max:2048",
            "flazz_or_id" => "required|mimes:png,jpeg,jpg|max:2048",
            "team_id" => "required",
        ]);
        if (User::where('email', $request->email)->exists()) {
            return response()->json([
            'message' => 'Email already exists',
            ], 400);
        }

        // dd($request);
        
        $filePath = public_path('storage/cv');
        $file = $request->file(key: 'cv');
        $cv_fileName = "{$request->group_name}-CV." . $file->getClientOriginalExtension();
        $file->move($filePath, $cv_fileName);
        $cv_final_fileName = "storage/cv/{$cv_fileName}";
        
        
        $filePath = public_path('storage/flazz_or_id');
        $file = $request->file(key: 'flazz_or_id');
        $flazz_or_id_fileName = "{$request->group_name}-flazz_or_id" . $file->getClientOriginalExtension();
        $file->move($filePath, $flazz_or_id_fileName);
        $flazz_or_id_final_fileName = "storage/flazz_or_id/{$flazz_or_id_fileName}";
        
        // dd($cv_fileName . $cv_final_fileName);
        try{
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                "email" => $request->email,
                "role" => $request->role,
            ]);
            
            usersData::create([
                "userId" => $user->id,
                "whatsapp_number"=> $request->whatsapp_number,
                "line_id" => $request->line_id,
                "github_gitlab_id" => $request->github_gitlab_id,
                "birthplace" => $request->birthplace,
                "birthdate" => $request->birthdate,
                "cv_path" => $cv_final_fileName,
                "flazz_or_id_card_path" => $flazz_or_id_final_fileName,
            ]);
            $shit = userTeam::create([
                'user_id' => $user->id,
                'team_id' => $request->team_id,
            ]);
            return redirect()->route('login')->with('success', 'register successful!');
        }catch (\Exception $e){
            dd($e);
        }
        
    }
    public function login(Request $request){
        $request->validate([
            'team_name' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
    
        
        $team = Team::where('team_name', $request->team_name)->first();
        if (!$team || !Hash::check($request->password, $team->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        Auth::guard('team')->login($team);
        
        $request->session()->regenerate();
        $filteredTeam = $team->only(['teamId', 'team_name']);
        $userTeam = userTeam::where('team_id', $team->teamId)        ->first();
        $userData = usersData::where('userId', $userTeam->user_id)->first();
        return view('user.userDashboard')->with(['team' => $filteredTeam, 'userData' => $userData]);
        
        
    }
    public function adminLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // dd(Hash::make("Hanjen1619"));
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        
        Auth::guard('admin')->login($admin);
        $request->session()->regenerate();
        return redirect()->route('adminDashboardView')->with('success', 'Login successful!');
    }
    public function adminLogout(Request $request){
        $user = Auth::guard('admin')->user();

        if (!$user) {
            return response()->json(['message' => 'No user logged in'], 400);
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('viewAdminLogin')->with('success', 'Logout successful!');
    }
    public function teamLogout(Request $request){
        $user = Auth::guard('team')->user();

        if (!$user) {
            return response()->json(['message' => 'No user logged in'], 400);
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('viewAdminLogin')->with('success', 'Logout successful!');
    }
}