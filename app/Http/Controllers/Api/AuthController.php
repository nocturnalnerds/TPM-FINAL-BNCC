<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller{
    public function register(Request $request){
        $request->validate([
            "group_name" => "required|unique:users|string|max:255",
            "password" => "required|string|max:255",
            "leader_name" => "required|string|max:255",
            "email" => "required|unique:users|string|max:255",
            "whatsapp_number" => "required|string|max:255",
            "line_id" => "required|string|max:255",
            "github_gitlab_id" => "required|string|max:255",
            "birthplace" => "required|string|max:255",
            "birhdate" => "required|date|max:255",
            "cv" => "required|mimes:pdf|max:2048",
            "flazz_or_id" => "required|mimes:png,jpeg,jpg|max:2048",
        ]);
        
        $filePath = public_path('storage/cv');
        $file = $request->file(key: 'cv');
        $cv_fileName = $request->group_name . '-CV';
        $file->move($filePath, $cv_fileName);
        $cv_fileName = 'storage/cv/' . $cv_fileName;
        
        $filePath = public_path('storage/flazz_or_id');
        $file = $request->file(key: 'flazz_or_id');
        $flazz_or_id_fileName = $request->group_name . '-flazz_or_id';
        $file->move($filePath, $flazz_or_id_fileName);
        $flazz_or_id_fileName = 'storage/flazz_or_id/' . $flazz_or_id_fileName;
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
            "cv_path" => $cv_fileName,
            "flazz_or_id_card_path" => $flazz_or_id_fileName,
        ]);
        return response()->json([
            'message' => 'Registration successful',
            'data' => [
                'group_name' => $request->group_name,
                'leader_name' => $request->leader_name,
                'email' => $request->email,
                'whatsapp_number' => $request->whatsapp_number,
                'line_id' => $request->line_id,
                'github_gitlab_id' => $request->github_gitlab_id,
                'birthplace' => $request->birthplace,
                'birthdate' => $request->birthdate,
                'cv_path' => $cv_fileName,
                'flazz_or_id_card_path' => $flazz_or_id_fileName,
            ]
        ], 201);
    }
    public function login(Request $request){
        $request->validate([
            'group_name' => 'required|string',
            'password' => 'required|string',
        ]);
        dd($request);

        $user = User::where('group_name', $request->group_name)->first();

        if (!$user || $user->password !== $request->password) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'data' => [
                'group_name' => $user->group_name,
                'leader_name' => $user->leader_name,
                'email' => $user->email,
                'whatsapp_number' => $user->whatsapp_number,
                'line_id' => $user->line_id,
                'github_gitlab_id' => $user->github_gitlab_id,
                'birthplace' => $user->birthplace,
                'birthdate' => $user->birthdate,
                'cv_path' => $user->cv_path,
                'flazz_or_id_card_path' => $user->flazz_or_id_card_path,
            ]
        ], 200);
    }
}