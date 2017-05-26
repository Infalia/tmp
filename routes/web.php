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
Route::get('profile/basic-info', 'ProfileController@basicInfo');
Route::get('profile/work', 'ProfileController@work');
Route::get('profile/interests', 'ProfileController@interests');
Route::get('profile/social-accounts', 'ProfileController@socialAccounts');
Route::get('profile/reset', 'ProfileController@resetData');
Route::get('profile/social-data', 'ProfileController@socialData');

/*** Timeline ***/
Route::get('timeline', 'TimelineController@index');

/*** Initiatives ***/
Route::get('offers', 'InitiativeController@initiatives');
Route::get('offer/new', 'InitiativeController@initiativeForm');
Route::post('offer/save', 'InitiativeController@storeInitiative');
Route::post('offer/image/upload', 'InitiativeController@imageUpload');
Route::post('offer/post-to-ontomap', 'InitiativeController@postToOnToMap');

/*** Notifications ***/
Route::get('notifications', 'NotificationController@index');

/*** Accessibility ***/
Route::get('accessibility/wizard', 'AccessibilityController@index');
Route::post('accessibility/save-options', 'AccessibilityController@storeUserAccessibilityOptions');

/*** UWUM ***/
Route::post('uwum/check-user', 'UwumController@checkUser');

/*** UWUM authentication ***/
Route::get('login/uwum', 'Auth\UwumLoginController@redirectToUwumProvider');
Route::get('login/uwum/callback', 'Auth\UwumLoginController@handleUwumCallback');

/*** Socialite ***/
Route::get('login/facebook', 'Auth\SocialLoginController@redirectToFacebookProvider');
Route::get('login/facebook/callback', 'Auth\SocialLoginController@handleFacebookProviderCallback');

Route::get('login/google', 'Auth\SocialLoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\SocialLoginController@handleGoogleProviderCallback');

Route::get('login/linkedin', 'Auth\SocialLoginController@redirectToLinkedinProvider');
Route::get('login/linkedin/callback', 'Auth\SocialLoginController@handleLinkedinProviderCallback');

Route::get('login/twitter', 'Auth\SocialLoginController@redirectToTwitterProvider');
Route::get('login/twitter/callback', 'Auth\SocialLoginController@handleTwitterProviderCallback');

Route::get('login/pinterest', 'Auth\SocialLoginController@redirectToPinterestProvider');
Route::get('login/pinterest/callback', 'Auth\SocialLoginController@handlePinterestProviderCallback');
