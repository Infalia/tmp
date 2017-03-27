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

Route::get('/', 'HomeController@index');
//Route::get('/{locale}', 'HomeController@index', function ($locale) {
//    App::setLocale($locale);
//});

/*** User profile ***/
Route::get('profile/basic-info', 'ProfileController@index');
Route::get('profile/work', 'ProfileController@work');
Route::get('profile/interests', 'ProfileController@interests');
Route::get('profile/social-accounts', 'ProfileController@socialAccounts');

/*** Timeline ***/
Route::get('timeline', 'TimelineController@index');

/*** Offers ***/
Route::get('offers', 'OfferController@index');

/*** Notifications ***/
Route::get('notifications', 'NotificationController@index');

/*** Accessibility ***/
Route::get('accessibility/wizard', 'AccessibilityController@index');
Route::post('accessibility/save-options', 'AccessibilityController@storeUserAccessibilityOptions');
