<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $teams = Team::all();
        return Response::json([
            'status'    => 'success',
            'response'  => $teams
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $teamData = $request->all();
        $team  = new Team;
        $team->name = $teamData['name'];
        $userIDs = $teamData['userIDs'];
        $team->save();
        foreach($userIDs as $userID)
        {
            $user = User::find($userID);
            $user->teams()->attach($team);
            $team->users()->attach($user);

        }


        return  Response::json([
            'status'=> 'success',
            'team' => $team

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $team = Team::find($id);

        return Response::json([
            'status' => 'success',
            'response' => $team
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $teamData = $request->all();
        $team = Team::find($id);
        $teamOldUsers = $team->users_ids;
        $temp = [];
        $userDiff = array_diff($teamData['userIDs'],$teamOldUsers);
        $userDiff = array_merge($temp,$userDiff); // users who are not in that team anymore

        /**
         * Delete teamID from the teams_ids of those users they are not in the team anymore
         */
        foreach($userDiff as $userID){
            $theUser = User::find($userID);
            $theUser->teams()->detach($id);
            $theUser->save();
        }

        /**
         * Update name and users
         */
        $team->name = $teamData['name'];
        $userIDs = $teamData['userIDs'];
        foreach ($userIDs as $userID){
            $user = User::find($userID);
            $user->teams()->attach($team); // set the teamID for users

        }
        $team->users()->sync($userIDs); // set the userIDs for the team
        $team->save();
        return Response::json([
            'status'=>'success',
            'response'=> $team
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $team = Team::find($id);
        $team->delete();

        return Response::json([
            'status'=>'success'
        ]);
    }
}
