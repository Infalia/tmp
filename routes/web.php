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

// Route::get('/', 'HomeController@index');
Route::get('/', 'InitiativeController@initiatives');
//Route::get('/{locale}', 'HomeController@index', function ($locale) {
//    App::setLocale($locale);
//});

Route::get('404', 'ErrorPageController@page404');

/*** User profile ***/
Route::get('profile/basic-info', 'ProfileController@basicInfo')->middleware('uwumAuth');
Route::get('profile/work', 'ProfileController@work')->middleware('uwumAuth');
Route::get('profile/interests', 'ProfileController@interests')->middleware('uwumAuth');
Route::get('profile/social-accounts', 'ProfileController@socialAccounts')->middleware('uwumAuth');
Route::get('profile/reset', 'ProfileController@resetData')->middleware('uwumAuth');
Route::get('profile/social-data', 'ProfileController@socialData');

/*** Timeline ***/
Route::get('timeline', 'TimelineController@index')->middleware('uwumAuth');

/*** Initiatives ***/
Route::get('offers', 'InitiativeController@initiatives');
Route::get('offer/{id}/{title}', 'InitiativeController@initiative');
Route::get('offer/new', 'InitiativeController@initiativeForm')->middleware('uwumAuth');
Route::get('offer/edit/{id}/{title}', 'InitiativeController@initiativeEditForm')->middleware('curUserAuth');
Route::get('offer/comments', 'InitiativeController@initiativeComments');
Route::post('offer/save', 'InitiativeController@storeInitiative')->middleware('uwumAuth');
Route::post('offer/update/{id}', 'InitiativeController@updateInitiative')->middleware('curUserAuth');
Route::post('offer/delete/{id}', 'InitiativeController@deleteInitiative')->middleware('curUserAuth');
Route::post('offer/image/upload', 'InitiativeController@imageUpload')->middleware('uwumAuth');
Route::post('offer/image/remove', 'InitiativeController@imageRemove');
Route::post('offer/post-to-ontomap', 'InitiativeController@postToOnToMap');
Route::post('offer/save/supporter', 'InitiativeController@storeInitiativeSupporter')->middleware('uwumAuth');
Route::post('offer/save/comment', 'InitiativeController@storeInitiativeComment')->middleware('uwumAuth');

/*** Notifications ***/
Route::get('notifications', 'NotificationController@index')->middleware('uwumAuth');

/*** Accessibility ***/
Route::get('accessibility/wizard', 'AccessibilityController@index')->middleware('uwumAuth');
Route::post('accessibility/save-options', 'AccessibilityController@storeUserAccessibilityOptions');

/*** UWUM ***/
Route::post('uwum/check-user', 'UwumController@checkUser');

/*** UWUM authentication ***/
Route::get('login/uwum', 'Auth\UwumLoginController@redirectToUwumProvider');
Route::get('login/uwum/callback', 'Auth\UwumLoginController@handleUwumCallback');

/*** Socialite ***/
Route::get('login/facebook', 'Auth\SocialLoginController@redirectToFacebookProvider')->middleware('uwumAuth');
Route::get('login/facebook/callback', 'Auth\SocialLoginController@handleFacebookProviderCallback')->middleware('uwumAuth');

Route::get('login/google', 'Auth\SocialLoginController@redirectToGoogleProvider')->middleware('uwumAuth');
Route::get('login/google/callback', 'Auth\SocialLoginController@handleGoogleProviderCallback')->middleware('uwumAuth');

Route::get('login/linkedin', 'Auth\SocialLoginController@redirectToLinkedinProvider')->middleware('uwumAuth');
Route::get('login/linkedin/callback', 'Auth\SocialLoginController@handleLinkedinProviderCallback')->middleware('uwumAuth');

Route::get('login/twitter', 'Auth\SocialLoginController@redirectToTwitterProvider')->middleware('uwumAuth');
Route::get('login/twitter/callback', 'Auth\SocialLoginController@handleTwitterProviderCallback')->middleware('uwumAuth');

Route::post('account/remove', 'Auth\SocialLoginController@removeAccount');
