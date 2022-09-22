<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display all projects of a specific user
     *
     * @param string $userID
     * @return JsonResponse
     */
    public function index(string $userID): JsonResponse
    {

        $teams = Team::query()->whereIn('users_ids',[$userID])->get(); // those team that specific user are in them
        /**
         * query for projects that specific user are in the team of that project
         */
        $projects = Project::query()->with(['team'])
            ->whereHas('team' , function ($q) use($userID) {
                $q->whereIn('users_ids',[$userID]);
            })
        ->get();

        return Response::json([
            'status' => 'success',
            'response'=> $projects
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

        $projectData = $request->all();
        $validator = Validator::make($projectData,[
            "name" => ["required","string","max:50"],
            "teamID" => ["required","string"]
        ]);
        if($validator->fails()){
            abort(400,$validator->errors());
        }
        $team = Team::find($projectData['teamID']);

        $project = new Project;
        $project->name = $projectData['name'];
        $project->team()->associate($team)->save();
        $project->save();

        return Response::json([
            'status'=>'success',
            'response' => $project
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $projectID
     * @return JsonResponse
     */
    public function show(string $projectID): JsonResponse
    {


        return Response::json([
            'status'    => 'success',
            'response'  =>
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
