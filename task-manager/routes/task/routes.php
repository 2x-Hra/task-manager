<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::post('/create/{creatorID}/projects/{projectID}',[TaskController::class,'store']);
Route::get('/{taskID}/users/{currentUserID}',[TaskController::class,'show']);
Route::delete('/{taskID}',[TaskController::class, 'destroy']);
Route::get('',[TaskController::class,'index']);
Route::patch('{taskID}',[TaskController::class,'update']);
/**
 *
 */


