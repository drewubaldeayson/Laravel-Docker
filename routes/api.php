<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function () {

    //Authentication
    Route::post('auth', 'AuthenticationController@authenticateProvider');

    //Fetch Player Information
    Route::post('info', 'PlayerController@getPlayerInformation');

    //Withdraw Balance
    Route::post('withdraw', 'TransactionController@withdraw');

    //Deposit Balance
    Route::post('deposit', 'TransactionController@deposit');

    //Rollback Transaction
    Route::post('rollback', 'TransactionController@rollback');

    //Player Notification Callback
    Route::post('playerNotificationCallback', 'PlayerNotificationController@callbackPlayerNotification');
    
});
