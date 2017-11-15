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
Route::post('profile/basic-info/save', 'ProfileController@storeBasicInfo')->middleware('uwumAuth');
Route::post('profile/basic-info/image/remove', 'ProfileController@imageRemove')->middleware('uwumAuth');
Route::post('profile/position', 'ProfileController@getUserPosition')->middleware('uwumAuth');
Route::post('profile/position/save', 'ProfileController@storeUserPosition')->middleware('uwumAuth');
Route::post('profile/position/delete', 'ProfileController@deleteUserPosition')->middleware('uwumAuth');
Route::post('profile/studies', 'ProfileController@getUserStudies')->middleware('uwumAuth');
Route::post('profile/studies/save', 'ProfileController@storeUserStudies')->middleware('uwumAuth');
Route::post('profile/studies/delete', 'ProfileController@deleteUserStudies')->middleware('uwumAuth');
Route::post('profile/skill', 'ProfileController@getUserSkill')->middleware('uwumAuth');
Route::post('profile/skill/save', 'ProfileController@storeUserSkill')->middleware('uwumAuth');
Route::post('profile/skill/delete', 'ProfileController@deleteUserSkill')->middleware('uwumAuth');
Route::post('profile/interest', 'ProfileController@getUserInterest')->middleware('uwumAuth');
Route::post('profile/interest/save', 'ProfileController@storeUserInterest')->middleware('uwumAuth');
Route::post('profile/interest/delete', 'ProfileController@deleteUserInterest')->middleware('uwumAuth');
Route::post('profile/area', 'ProfileController@getUserArea')->middleware('uwumAuth');
Route::post('profile/area/save', 'ProfileController@storeUserArea')->middleware('uwumAuth');
Route::post('profile/area/delete', 'ProfileController@deleteUserArea')->middleware('uwumAuth');

Route::get('profile/work/positions', function () {
    return view('partials.user-positions', [
        'profileHeading1' => __('messages.profile_work_heading_1'),
        'profileLbl1' => __('messages.profile_work_lbl_1'),
        'profileLbl2' => __('messages.profile_work_lbl_2'),
        'profileText1' => __('messages.profile_work_text_1'),
        'profileText2' => __('messages.profile_work_text_2'),
        'profileAddBtn1' => __('messages.profile_work_add_btn_1'),
        'profileEditBtn' => __('messages.form_edit_btn'),
        'profileRemoveBtn' => __('messages.form_remove_btn'),
        'profileMsg2' => __('messages.profile_work_msg_2'),
        'user' => App\User::find(Auth::id())
    ]);
});

Route::get('profile/work/studies', function () {
    return view('partials.user-studies', [
        'profileHeading2' => __('messages.profile_work_heading_2'),
        'profileLbl1' => __('messages.profile_work_lbl_1'),
        'profileLbl3' => __('messages.profile_work_lbl_3'),
        'profileAddBtn2' => __('messages.profile_work_add_btn_2'),
        'profileEditBtn' => __('messages.form_edit_btn'),
        'profileRemoveBtn' => __('messages.form_remove_btn'),
        'profileMsg2' => __('messages.profile_work_msg_2'),
        'user' => App\User::find(Auth::id())
    ]);
});

Route::get('profile/work/skill', function () {
    return view('partials.user-skills', [
        'profileHeading3' => __('messages.profile_work_heading_3'),
        'profileFormSkillLbl' => __('messages.profile_form_skill_lbl'),
        'profileAddBtn3' => __('messages.profile_work_add_btn_3'),
        'profileEditBtn' => __('messages.form_edit_btn'),
        'profileRemoveBtn' => __('messages.form_remove_btn'),
        'profileMsg2' => __('messages.profile_work_msg_2'),
        'user' => App\User::find(Auth::id())
    ]);
});

Route::get('profile/interests/interest', function () {
    return view('partials.user-interests', [
        'profileHeading1' => __('messages.profile_interests_heading_1'),
        'profileFormInterestLbl' => __('messages.profile_form_interest_lbl'),
        'profileAddBtn1' => __('messages.profile_interests_add_btn_1'),
        'profileEditBtn' => __('messages.form_edit_btn'),
        'profileRemoveBtn' => __('messages.form_remove_btn'),
        'profileMsg1' => __('messages.profile_interests_msg_1'),
        'user' => App\User::find(Auth::id())
    ]);
});

Route::get('profile/interests/area', function () {
    return view('partials.user-areas', [
        'profileHeading2' => __('messages.profile_interests_heading_2'),
        'profileFormAreaLbl' => __('messages.profile_form_area_lbl'),
        'profileAddBtn2' => __('messages.profile_interests_add_btn_2'),
        'profileEditBtn' => __('messages.form_edit_btn'),
        'profileRemoveBtn' => __('messages.form_remove_btn'),
        'profileMsg2' => __('messages.profile_interests_msg_2'),
        'user' => App\User::find(Auth::id())
    ]);
});


/*** Timeline ***/
Route::get('timeline', 'TimelineController@index')->middleware('uwumAuth');

/*** Initiatives ***/
Route::get('offers', 'InitiativeController@initiatives');
Route::get('offer/new', 'InitiativeController@initiativeForm')->middleware('uwumAuth');
Route::get('offer/edit/{id}/{title}', 'InitiativeController@initiativeEditForm')->middleware('curUserAuth');
Route::get('offer/comments', 'InitiativeController@initiativeComments');
Route::get('offer/{id}/{title}', 'InitiativeController@initiative');
Route::post('offer/save', 'InitiativeController@storeInitiative')->middleware('uwumAuth');
Route::post('offer/update/{id}', 'InitiativeController@updateInitiative')->middleware('curUserAuth');
Route::post('offer/delete/{id}', 'InitiativeController@deleteInitiative')->middleware('curUserAuth');
Route::post('offer/image/upload', 'InitiativeController@imageUpload')->middleware('uwumAuth');
Route::post('offer/image/remove', 'InitiativeController@imageRemove');
Route::post('offer/save/supporter', 'InitiativeController@storeInitiativeSupporter')->middleware('uwumAuth');
Route::post('offer/save/comment', 'InitiativeController@storeInitiativeComment')->middleware('uwumAuth');
Route::post('offer/save/ontomap', 'InitiativeController@storeInitiativeOnToMap')->middleware('uwumAuth');
Route::post('offer/update/ontomap/{id}', 'InitiativeController@updateInitiativeOnToMap')->middleware('curUserAuth');
Route::post('offer/delete/ontomap/{id}', 'InitiativeController@deleteInitiativeOnToMap')->middleware('uwumAuth');
Route::post('offer/ontomap/comment', 'InitiativeController@storeCommentOnToMap')->middleware('uwumAuth');
Route::post('offer/ontomap/supporter', 'InitiativeController@supporterOnToMap')->middleware('uwumAuth');

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

/*** OnToMap ***/
Route::get('ontomap/get-events', 'OnToMapController@getUserEvents');
Route::get('ontomap/get-mappings', 'OnToMapController@getMappings');
Route::get('ontomap/send-mappings', 'OnToMapController@sendMappings');

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
