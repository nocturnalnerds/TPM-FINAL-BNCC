<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller{
    public function register(Request $request){
        $request->validate([
            "group_name" => "required|string|max:255",
            "password" => "required|string|max:255",
            "leader_name" => "required|string|max:255",
            "email" => "required|string|max:255",
            "whatsapp_number" => "required|string|max:255",
            "line_id" => "required|string|max:255",
            "github_gitlab_id" => "required|string|max:255",
            "birthplace" => "required|string|max:255",
            "birthdate" => "required|string|max:255",
            "cv" => "required|mimes:pdf|max:2048",
            "flazz_or_id" => "required|mimes:png,jpeg,jpg|max:2048",
        ]);
        if (User::where('email', $request->email)->exists()) {
            return response()->json([
            'message' => 'Email already exists',
            ], 400);
        }

        if (User::where('group_name', $request->group_name)->exists()) {
            return response()->json([
            'message' => 'Group name already exists',
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
            User::create([
                'group_name' => $request->group_name,
                'password' => $request->password,
                'leader_name' => $request->leader_name,
                "email" => $request->email,
                "whatsapp_number"=> $request->whatsapp_number,
                "line_id" => $request->line_id,
                "github_gitlab_id" => $request->github_gitlab_id,
                "birthplace" => $request->birthplace,
                "birthdate" => $request->birthdate,
                "cv_path" => $cv_final_fileName,
                "flazz_or_id_card_path" => $flazz_or_id_final_fileName,
            ]);
            return response()->json([
                'message' => 'Account Successfully Created',
            ], 201);
        }catch (\Exception $e){
            dd($e);
        }
        
    }
    public function login(Request $request){
        $request->validate([
            'group_name' => 'required|string',
            'password' => 'required|string',
        ]);
        // dd($request);

        $user = User::where('group_name', $request->group_name)->first();
        // dd($user);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
            'message' => 'Invalid credentials'
            ], 401);
        }
        $request->session()->regenerate();
        $tokenResult = $user->createToken('authToken');
        $token = $tokenResult->accessToken;
            
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Login successful'
            ], 200);
            

        
    }
}