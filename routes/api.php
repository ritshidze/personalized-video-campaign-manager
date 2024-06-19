<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/***
 * Client routes
 */
Route::post('user/store', [UserController::class, 'store']);

/***
 * User api routes
 */
Route::post('client/store', [ClientController::class, 'store']);

/***
 * Campaign api routes
 */

Route::post('/campaigns', [CampaignController::class, 'store']);
Route::post('/campaigns/{campaign}/data', [CampaignController::class, 'campaignUserData'])->where('campaign', '[0-9]+');;

