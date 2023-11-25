<?php

use App\Http\Controllers\api\LeaguesController;
use App\Http\Controllers\api\MachController;
use App\Http\Controllers\api\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\TeamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("get/data", [UserController::class, "Getdata"]);


Route::get("where/{fnid}", [UserController::class, "whereUser"]);
Route::get("user/{id}", [UserController::class, "user"]);
Route::post("post/user", [UserController::class, "store"]);
Route::post("update/user/{id}", [UserController::class, "update"]);
Route::post("delete/user/{id}", [UserController::class, "delete"]);


Route::get("get/posts", [PostsController::class, "index"]);
Route::post("post/posts", [PostsController::class, "store"]);
Route::post("update/posts/{id}", [PostsController::class, "update"]);
Route::post("delete/posts/{id}", [PostsController::class, "delete"]);


Route::get("get/teams/{id}", [TeamController::class, "index"]);
Route::get("get/teams/withuser/{id}", [TeamController::class, "userTeam"]);
Route::post("post/teams/{id}", [TeamController::class, "store"]);
Route::post("update/teams/{id}", [TeamController::class, "update"]);
Route::post("delete/teams/{id}", [TeamController::class, "delete"]);
Route::get("get/user/{id}", [TeamController::class, "getUser"]);
Route::post("add/user/teams/{id}/{user}", [TeamController::class, "addUserinTeam"]);



Route::get("get/league", [LeaguesController::class, "index"]);
Route::get("get/league/team/{id}", [LeaguesController::class, "leagueTeam"]);
Route::post("post/league", [LeaguesController::class, "store"]);
Route::post("update/league/{id}", [LeaguesController::class, "update"]);
Route::post("delete/league/{id}", [LeaguesController::class, "delete"]);
Route::get("user/league/{id}", [LeaguesController::class, "getUserLeague"]);


Route::get("match/random", [MachController::class, 'handle']);
Route::get("team/match", [MachController::class, 'teamsMatch']);
