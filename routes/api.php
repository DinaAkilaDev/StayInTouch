<?php

use Illuminate\Http\Request;
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
use \App\Http\Controllers\Api;

Route::group([],function () {

    Route::post('login',[Api\UserController::class,'login']);
    Route::post('signup',[Api\UserController::class,'signup']);
    Route::post('password/forgot-password', [Api\UserController::class,'forgotPassword']);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::put('/edit',[Api\UserController::class,'edit']);
        Route::post('/logout',[Api\UserController::class,'logout']);


        Route::post('/showcontact',[Api\ContactController::class,'show']);
        Route::post('/addcontact',[Api\ContactController::class,'add']);
        Route::put('/editcontact/{id}',[Api\ContactController::class,'edit']);
        Route::delete('/deletecontact/{id}',[Api\ContactController::class,'delete']);

        Route::post('/showevent',[Api\EventController::class,'show']);
        Route::post('/addevent',[Api\EventController::class,'add']);
        Route::put('/editevent/{id}',[Api\EventController::class,'edit']);
        Route::delete('/deleteevent/{id}',[Api\EventController::class,'delete']);

        Route::post('/sendemail/{event}',[Api\EventController::class,'sendemail']);
        Route::post('/sendsms/{event}',[Api\EventController::class,'sendsms']);

    });
});
