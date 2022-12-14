<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// define admin routes here

    Route::post('/create/{creatorID}',[ProjectController::class, 'store']);
    Route::get('users/{userID}/get-projects',[ProjectController::class,'index']);
    Route::get('{projectID}',[ProjectController::class,'show']);
    Route::patch('{projectID}',[ProjectController::class,'update']);
    Route::delete('{projectID}',[ProjectController::class,'destroy']);

        /**
         * get-all-projects
         * get-projects
         * remove-multiple-projects
         * store
         * update
         * destroy
         * index
         * show{userID}{projectID}
         */


