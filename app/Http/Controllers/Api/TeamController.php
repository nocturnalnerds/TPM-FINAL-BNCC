<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller{
    public function teamList(){
        $teams = User::all();
        $teams = User::select('id', 'name',)->get();
        return response()->json(['success' => true, 'teams' => $teams], 200);
    }
    public function teamListNumPage(Request $request){
        try{
            $request->validate([
                'show_num' => 'required|integer',
                'page' => 'required|integer',
            ]);
        }catch(\Exception $e){
            dd($e);
            return response()->json(["message" => "Invalid input"],500);
        }
        
        $perPage = $request->show_num;
        $page = $request->page;
        $teams = User::select('id', 'name')
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();
        return response()->json(['success' => true, 'teams' => $teams], 200);
    }
    public function showTeamSorted(Request $request){
        try{
            $request->validate([
                'stat' => 'required|boolean',
            ]);
        }catch(\Exception $e){
            dd($e);
            return response()->json(['message'=> 'Invalid Input'],500);
        }
        $order = $request->stat ? 'asc' : 'desc';
        $teams = User::select('id', 'name')
                    ->orderBy('name', $order)
                    ->get();
        return response()->json(['success' => true, 'teams' => $teams], 200);
    }
    public function searchByName(Request $request){
        try{
            $request->validate([
                'name' => 'required|string',
            ]);
        }catch(\Exception $e){
            dd($e);
            return response()->json(['message'=> 'Invalid Input'],500);
        }
        $name = $request->name;
        $teams = User::select('id', 'name')
                    ->where('name', 'like', $name . '%')
                    ->get();
        return response()->json(['success' => true, 'teams' => $teams], 200);
    }
    public function editTeam(Request $request){
        try{
            $request->validate([
                'id' => 'required|integer|exists:users,id',
                'name' => 'required|string',
            ]);
        }
        $team = User::find($request->id);
        $team->name = $request->name;
        $team->save();

        return response()->json(['success' => true, 'team' => $team], 200);
    }
}