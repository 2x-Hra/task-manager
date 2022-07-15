<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// define admin routes here
Route::group(
    ['prefix' => 'users'],
    function () {

        /**
         * get-users: for showing all the users
         * delete-multiple-users
         * change-password : Hard
         * index : to show
         * store : to create data and store in DB
         * destroy: to delete a data with given ID form DB
         * show-user-teams : to show the user's teams
         */

    }
);

//Route::group(
//    ['prefix' => 'users', 'middleware' => ['auth:api', 'isActive']],
//    function () {
//        Route::get('/{userID}', 'UserController@show');
//        Route::patch('/{id}', 'UserController@update');
//    }
//);

