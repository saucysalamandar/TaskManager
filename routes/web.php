<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "HomeController@Index")->name("Home");

Route::get('/login', "HomeController@Login");

Route::post('/login', "HomeController@CheckLogin");

Route::group([ "prefix" => "project", ], function(){

    Route::get("/new", 'ProjectController@create');

    Route::post("/new", 'ProjectController@store');

    Route::get("/{id}", "ProjectController@show")->name("ProjectMilestones");

});

Route::group(["prefix" => "milestones"], function(){

    Route::get('/{projectid}', "MilestoneController@index")->name('milestonesIndex');

});
