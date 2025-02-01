<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{
    public function getUserById($id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['message'=> 'succes', "user" => $user ],200);
    }
    public function getUsersByTeamId($teamId){
        $users = User::whereHas('teams', function ($query) use ($teamId) {
            $query->where('team_id', $teamId);
        })->get();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found for this team'], 404);
        }

        return response()->json(['message' => 'success', 'users' => $users], 200);
    }
    public function editUser($id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['message' => 'success', 'user' => $user], 200);
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update($request->all());

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }
}