<?php

use Illuminate\Http\Request;
use App\Position;
use App\University;
use App\Study;
use App\Skill;
use App\Interest;
use App\City;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*** Positions ***/
Route::get('/positions/{query?}', function($query = null) {
    if(isset($query)) {
        return Position::listsTranslations('name')
            ->where('name', 'ILIKE', "%{$query}%")
            ->get();
    }
    else {
        return Position::all();
    }
});

/*** Universities ***/
Route::get('/universities/{query?}', function($query = null) {
    if(isset($query)) {
        return University::listsTranslations('name')
            ->where('name', 'ILIKE', "%{$query}%")
            ->get();
    }
    else {
        return University::all();
    }
});

/*** Studies ***/
Route::get('/studies/{query?}', function($query = null) {
    if(isset($query)) {
        return Study::listsTranslations('name')
            ->where('name', 'ILIKE', "%{$query}%")
            ->get();
    }
    else {
        return Study::all();
    }
});

/*** Skills ***/
Route::get('/skills/{query?}', function($query = null) {
    if(isset($query)) {
        return Skill::listsTranslations('name')
            ->where('name', 'ILIKE', "%{$query}%")
            ->get();
    }
    else {
        return Skill::all();
    }
});

/*** Interests ***/
Route::get('/interests/{query?}', function($query = null) {
    if(isset($query)) {
        return Interest::listsTranslations('name')
            ->where('name', 'ILIKE', "%{$query}%")
            ->get();
    }
    else {
        return Interest::all();
    }
});

/*** Cities ***/
Route::get('/cities/{query?}', function($query = null) {
    if(isset($query)) {
        return City::listsTranslations('name')
            ->where('name', 'ILIKE', "%{$query}%")
            ->orWhere('subdivision_name', 'ILIKE', "%{$query}%")
            ->orWhere('country_name', 'ILIKE', "%{$query}%")
            ->get();
    }
    else {
        return City::all();
    }
});