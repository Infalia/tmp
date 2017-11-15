<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\UserDetail;
use App\UserPosition;
use App\UserStudy;
use App\UserSkill;
use App\UserInterest;
use App\UserArea;
use App\Gender;
use App\Language;
use App\SocialNetwork;
use App\Helpers\GoogleApi;
use Carbon\Carbon;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class ProfileController extends Controller
{
    function basicInfo()
    {
        $user = User::find(Auth::id());
        $userDetails = $user->userDetails;
        $userLanguages = $user->languages;
        $genders = Gender::all();
        $languages = Language::all();


        $miDate = Carbon::now()->subYears(100);
        $maDate = Carbon::now()->subYears(16);
        $minDate = $miDate->year.', '.($miDate->month-1).', '.$miDate->day;
        $maxDate = $maDate->year.', '.($maDate->month-1).', '.$maDate->day;

        $userImage = (empty($userDetails) && empty($userDetails->image)) ? '' : $userDetails->image;
        $userPhone = (empty($userDetails) && empty($userDetails->phone)) ? '' : $userDetails->phone;
        $userBirthday = (empty($userDetails) && empty($userDetails->birthday)) ? '' : $userDetails->birthday;
        $userGenderId = (empty($userDetails) && empty($userDetails->gender_id)) ? 0 : $userDetails->gender_id;
        $userDescription = (empty($userDetails) && empty($userDetails->description)) ? '' : $userDetails->description;

        if(!empty($userBirthday)) {
            $bDate = Carbon::createFromFormat('Y-m-d H:i:s', $userBirthday);
            $userBirthday = $bDate->year.', '.($bDate->month-1).', '.$bDate->day;
        }


        $userLanguageIds = array();

        foreach($userLanguages as $language) {
            $userLanguageIds[] = $language->id;
        }


        $route = Route::current();

        $sidebarOption1 = __('messages.sidebar_option_1');
        $sidebarOption2 = __('messages.sidebar_option_2');
        $sidebarOption3 = __('messages.sidebar_option_3');
        $sidebarOption4 = __('messages.sidebar_option_4');
        $sidebarOption5 = __('messages.sidebar_option_5');
        $sidebarOption6 = __('messages.sidebar_option_6');
        $sidebarOption7 = __('messages.sidebar_option_7');
        $sidebarOption8 = __('messages.sidebar_option_8');

        $profileOption1 = __('messages.profile_option_1');
        $profileOption2 = __('messages.profile_option_2');
        $profileOption3 = __('messages.profile_option_3');
        $profileOption4 = __('messages.profile_option_4');
        $profileOption5 = __('messages.profile_option_5');
        $profileOption6 = __('messages.profile_option_6');

        $pageTitle = __('messages.profile_basic_page_title');
        $metaDescription = __('messages.profile_basic_page_meta_description');
        $profileBasicHeading1 = __('messages.profile_basic_heading_1');
        $profileBasicBtn1 = __('messages.profile_basic_btn_1');
        $profileBasicBtn2 = __('messages.profile_basic_btn_2');

        // $emailLbl = __('messages.form_email_lbl');
        // $emailPldr = __('messages.form_email_pldr');
        $phoneLbl = __('messages.form_phone_lbl');
        $phonePldr = __('messages.form_phone_pldr');
        $birthdayLbl = __('messages.form_birthday_lbl');
        $birthdayPldr = __('messages.form_birthday_pldr');
        $namedayLbl = __('messages.form_nameday_lbl');
        $namedayPldr = __('messages.form_nameday_pldr');
        $maleLbl = __('messages.form_male_lbl');
        $femaleLbl = __('messages.form_female_lbl');
        $languagesLbl = __('messages.form_languages_lbl');
        $languagesPldr = __('messages.form_languages_pldr');
        $bioLbl = __('messages.form_bio_lbl');
        $bioPldr = __('messages.form_bio_pldr');
        $saveBtn = __('messages.form_save_btn');
        $cancelBtn = __('messages.form_cancel_btn');


        return view('profile.basic-info')
            ->with('sidebarOption1', $sidebarOption1)
            ->with('sidebarOption2', $sidebarOption2)
            ->with('sidebarOption3', $sidebarOption3)
            ->with('sidebarOption4', $sidebarOption4)
            ->with('sidebarOption5', $sidebarOption5)
            ->with('sidebarOption6', $sidebarOption6)
            ->with('sidebarOption7', $sidebarOption7)
            ->with('sidebarOption8', $sidebarOption8)
            ->with('profileOption1', $profileOption1)
            ->with('profileOption2', $profileOption2)
            ->with('profileOption3', $profileOption3)
            ->with('profileOption4', $profileOption4)
            ->with('profileOption5', $profileOption5)
            ->with('profileOption6', $profileOption6)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('profileBasicHeading1', $profileBasicHeading1)
            ->with('profileBasicBtn1', $profileBasicBtn1)
            ->with('profileBasicBtn2', $profileBasicBtn2)
            // ->with('emailLbl', $emailLbl)
            // ->with('emailPldr', $emailPldr)
            ->with('phoneLbl', $phoneLbl)
            ->with('phonePldr', $phonePldr)
            ->with('birthdayLbl', $birthdayLbl)
            ->with('birthdayPldr', $birthdayPldr)
            ->with('namedayLbl', $namedayLbl)
            ->with('namedayPldr', $namedayPldr)
            ->with('maleLbl', $maleLbl)
            ->with('femaleLbl', $femaleLbl)
            ->with('languagesLbl', $languagesLbl)
            ->with('languagesPldr', $languagesPldr)
            ->with('bioLbl', $bioLbl)
            ->with('bioPldr', $bioPldr)
            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn)
            ->with('user', $user)
            ->with('userDetails', $userDetails)
            ->with('genders', $genders)
            ->with('languages', $languages)
            ->with('minDate', $minDate)
            ->with('maxDate', $maxDate)
            ->with('userImage', $userImage)
            ->with('userPhone', $userPhone)
            ->with('userBirthday', $userBirthday)
            ->with('userGenderId', $userGenderId)
            ->with('userDescription', $userDescription)
            ->with('userLanguageIds', collect(array_flatten($userLanguageIds)))
            ->with('routeUri', $route->uri);
    }

    function work(Request $request)
    {
        $user = User::find(Auth::id());
        $route = Route::current();


        $sidebarOption1 = __('messages.sidebar_option_1');
        $sidebarOption2 = __('messages.sidebar_option_2');
        $sidebarOption3 = __('messages.sidebar_option_3');
        $sidebarOption4 = __('messages.sidebar_option_4');
        $sidebarOption5 = __('messages.sidebar_option_5');
        $sidebarOption6 = __('messages.sidebar_option_6');
        $sidebarOption7 = __('messages.sidebar_option_7');
        $sidebarOption8 = __('messages.sidebar_option_8');

        $profileOption1 = __('messages.profile_option_1');
        $profileOption2 = __('messages.profile_option_2');
        $profileOption3 = __('messages.profile_option_3');
        $profileOption4 = __('messages.profile_option_4');
        $profileOption5 = __('messages.profile_option_5');
        $profileOption6 = __('messages.profile_option_6');

        $pageTitle = __('messages.profile_work_page_title');
        $metaDescription = __('messages.profile_work_page_meta_description');
        $profileBasicHeading1 = __('messages.profile_basic_heading_1');

        $profileHeading1 = __('messages.profile_work_heading_1');
        $profileHeading2 = __('messages.profile_work_heading_2');
        $profileHeading3 = __('messages.profile_work_heading_3');
        $profileLbl1 = __('messages.profile_work_lbl_1');
        $profileLbl2 = __('messages.profile_work_lbl_2');
        $profileLbl3 = __('messages.profile_work_lbl_3');
        $profileText1 = __('messages.profile_work_text_1');
        $profileText2 = __('messages.profile_work_text_2');
        $profileAddBtn1 = __('messages.profile_work_add_btn_1');
        $profileAddBtn2 = __('messages.profile_work_add_btn_2');
        $profileAddBtn3 = __('messages.profile_work_add_btn_3');
        $profileEditBtn = __('messages.form_edit_btn');
        $profileRemoveBtn = __('messages.form_remove_btn');
        $profileMsg1 = __('messages.profile_work_msg_1');
        $profileMsg2 = __('messages.profile_work_msg_2');
        $profileMsg3 = __('messages.profile_work_msg_3');
        $deleteConfirmMsg = __('messages.form_confirm_msg_1');
        $profileFormCompanyLbl = __('messages.profile_form_company_lbl');
        $profileFormInstituteLbl = __('messages.profile_form_institute_lbl');
        $profileFormCityLbl = __('messages.profile_form_city_lbl');
        $profileFormRoleLbl = __('messages.profile_form_role_lbl');
        $profileFormCurrentLbl = __('messages.profile_form_is_current_lbl');
        $profileFormFromLbl = __('messages.profile_form_from_lbl');
        $profileFormToLbl = __('messages.profile_form_to_lbl');
        $profileFormStudiesLbl = __('messages.profile_form_studies_lbl');
        $profileFormSkillLbl = __('messages.profile_form_skill_lbl');
        
        $saveBtn = __('messages.form_save_btn');
        $cancelBtn = __('messages.form_cancel_btn');

        return view('profile.work')
            ->with('sidebarOption1', $sidebarOption1)
            ->with('sidebarOption2', $sidebarOption2)
            ->with('sidebarOption3', $sidebarOption3)
            ->with('sidebarOption4', $sidebarOption4)
            ->with('sidebarOption5', $sidebarOption5)
            ->with('sidebarOption6', $sidebarOption6)
            ->with('sidebarOption7', $sidebarOption7)
            ->with('sidebarOption8', $sidebarOption8)
            ->with('profileOption1', $profileOption1)
            ->with('profileOption2', $profileOption2)
            ->with('profileOption3', $profileOption3)
            ->with('profileOption4', $profileOption4)
            ->with('profileOption5', $profileOption5)
            ->with('profileOption6', $profileOption6)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('profileBasicHeading1', $profileBasicHeading1)
            ->with('profileHeading1', $profileHeading1)
            ->with('profileHeading2', $profileHeading2)
            ->with('profileHeading3', $profileHeading3)
            ->with('profileLbl1', $profileLbl1)
            ->with('profileLbl2', $profileLbl2)
            ->with('profileLbl3', $profileLbl3)
            ->with('profileText1', $profileText1)
            ->with('profileText2', $profileText2)
            ->with('profileAddBtn1', $profileAddBtn1)
            ->with('profileAddBtn2', $profileAddBtn2)
            ->with('profileAddBtn3', $profileAddBtn3)
            ->with('profileEditBtn', $profileEditBtn)
            ->with('profileRemoveBtn', $profileRemoveBtn)
            ->with('profileMsg1', $profileMsg1)
            ->with('profileMsg2', $profileMsg2)
            ->with('profileMsg3', $profileMsg3)
            ->with('deleteConfirmMsg', $deleteConfirmMsg)
            ->with('profileFormCompanyLbl', $profileFormCompanyLbl)
            ->with('profileFormInstituteLbl', $profileFormInstituteLbl)
            ->with('profileFormCityLbl', $profileFormCityLbl)
            ->with('profileFormRoleLbl', $profileFormRoleLbl)
            ->with('profileFormCurrentLbl', $profileFormCurrentLbl)
            ->with('profileFormFromLbl', $profileFormFromLbl)
            ->with('profileFormToLbl', $profileFormToLbl)
            ->with('profileFormStudiesLbl', $profileFormStudiesLbl)
            ->with('profileFormSkillLbl', $profileFormSkillLbl)
            ->with('user', $user)
            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn)
            ->with('routeUri', $route->uri);
    }

    function interests()
    {
        $user = User::find(Auth::id());
        $route = Route::current();

        $sidebarOption1 = __('messages.sidebar_option_1');
        $sidebarOption2 = __('messages.sidebar_option_2');
        $sidebarOption3 = __('messages.sidebar_option_3');
        $sidebarOption4 = __('messages.sidebar_option_4');
        $sidebarOption5 = __('messages.sidebar_option_5');
        $sidebarOption6 = __('messages.sidebar_option_6');
        $sidebarOption7 = __('messages.sidebar_option_7');
        $sidebarOption8 = __('messages.sidebar_option_8');

        $profileOption1 = __('messages.profile_option_1');
        $profileOption2 = __('messages.profile_option_2');
        $profileOption3 = __('messages.profile_option_3');
        $profileOption4 = __('messages.profile_option_4');
        $profileOption5 = __('messages.profile_option_5');
        $profileOption6 = __('messages.profile_option_6');

        $pageTitle = __('messages.profile_interests_page_title');
        $metaDescription = __('messages.profile_interests_page_meta_description');
        $profileBasicHeading1 = __('messages.profile_basic_heading_1');

        $profileHeading1 = __('messages.profile_interests_heading_1');
        $profileHeading2 = __('messages.profile_interests_heading_2');

        $profileAddBtn1 = __('messages.profile_interests_add_btn_1');
        $profileAddBtn2 = __('messages.profile_interests_add_btn_2');
        $profileEditBtn = __('messages.form_edit_btn');
        $profileRemoveBtn = __('messages.form_remove_btn');
        $profileMsg1 = __('messages.profile_interests_msg_1');
        $profileMsg2 = __('messages.profile_interests_msg_2');
        $deleteConfirmMsg = __('messages.form_confirm_msg_1');
        $profileFormInterestLbl = __('messages.profile_form_interest_lbl');
        $profileFormAreaLbl = __('messages.profile_form_area_lbl');

        $saveBtn = __('messages.form_save_btn');
        $cancelBtn = __('messages.form_cancel_btn');

        return view('profile.interests')
            ->with('sidebarOption1', $sidebarOption1)
            ->with('sidebarOption2', $sidebarOption2)
            ->with('sidebarOption3', $sidebarOption3)
            ->with('sidebarOption4', $sidebarOption4)
            ->with('sidebarOption5', $sidebarOption5)
            ->with('sidebarOption6', $sidebarOption6)
            ->with('sidebarOption7', $sidebarOption7)
            ->with('sidebarOption8', $sidebarOption8)
            ->with('profileOption1', $profileOption1)
            ->with('profileOption2', $profileOption2)
            ->with('profileOption3', $profileOption3)
            ->with('profileOption4', $profileOption4)
            ->with('profileOption5', $profileOption5)
	        ->with('profileOption6', $profileOption6)	
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('profileBasicHeading1', $profileBasicHeading1)
            ->with('profileHeading1', $profileHeading1)
            ->with('profileHeading2', $profileHeading2)
            ->with('profileAddBtn1', $profileAddBtn1)
            ->with('profileAddBtn2', $profileAddBtn2)
            ->with('profileEditBtn', $profileEditBtn)
            ->with('profileRemoveBtn', $profileRemoveBtn)
            ->with('profileMsg1', $profileMsg1)
            ->with('profileMsg2', $profileMsg2)
            ->with('deleteConfirmMsg', $deleteConfirmMsg)
            ->with('profileFormInterestLbl', $profileFormInterestLbl)
            ->with('profileFormAreaLbl', $profileFormAreaLbl)
            ->with('user', $user)
            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn)
            ->with('routeUri', $route->uri);
    }

    function socialAccounts()
    {
        $user = User::find(Auth::id());
        $route = Route::current();

        $sidebarOption1 = __('messages.sidebar_option_1');
        $sidebarOption2 = __('messages.sidebar_option_2');
        $sidebarOption3 = __('messages.sidebar_option_3');
        $sidebarOption4 = __('messages.sidebar_option_4');
        $sidebarOption5 = __('messages.sidebar_option_5');
        $sidebarOption6 = __('messages.sidebar_option_6');
        $sidebarOption7 = __('messages.sidebar_option_7');
        $sidebarOption8 = __('messages.sidebar_option_8');

        $profileOption1 = __('messages.profile_option_1');
        $profileOption2 = __('messages.profile_option_2');
        $profileOption3 = __('messages.profile_option_3');
        $profileOption4 = __('messages.profile_option_4');
        $profileOption5 = __('messages.profile_option_5');
        $profileOption6 = __('messages.profile_option_6');

        $pageTitle = __('messages.profile_social_accounts_page_title');
        $metaDescription = __('messages.profile_social_accounts_page_meta_description');
        $profileBasicHeading1 = __('messages.profile_basic_heading_1');

        $profileHeading1 = __('messages.profile_social_accounts_heading_1');
        $switchOn = __('messages.switch_on');
        $switchOff = __('messages.switch_off');

        $socialNetworks = SocialNetwork::all();
        $userSocialNetworks = User::find(Auth::id())->socialNetworks;


        return view('profile.social-accounts')
            ->with('sidebarOption1', $sidebarOption1)
            ->with('sidebarOption2', $sidebarOption2)
            ->with('sidebarOption3', $sidebarOption3)
            ->with('sidebarOption4', $sidebarOption4)
            ->with('sidebarOption5', $sidebarOption5)
            ->with('sidebarOption6', $sidebarOption6)
            ->with('sidebarOption7', $sidebarOption7)
            ->with('sidebarOption8', $sidebarOption8)
            ->with('profileOption1', $profileOption1)
            ->with('profileOption2', $profileOption2)
            ->with('profileOption3', $profileOption3)
            ->with('profileOption4', $profileOption4)
            ->with('profileOption5', $profileOption5)
            ->with('profileOption6', $profileOption6)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('profileBasicHeading1', $profileBasicHeading1)
            ->with('profileHeading1', $profileHeading1)
            ->with('switchOn', $switchOn)
            ->with('switchOff', $switchOff)
            ->with('user', $user)
            ->with('socialNetworks', $socialNetworks)
            ->with('userSocialNetworks', $userSocialNetworks)
            ->with('routeUri', $route->uri);
    }

    function resetData()
    {
        $user = User::find(Auth::id());
        $route = Route::current();

        $sidebarOption1 = __('messages.sidebar_option_1');
        $sidebarOption2 = __('messages.sidebar_option_2');
        $sidebarOption3 = __('messages.sidebar_option_3');
        $sidebarOption4 = __('messages.sidebar_option_4');
        $sidebarOption5 = __('messages.sidebar_option_5');
        $sidebarOption6 = __('messages.sidebar_option_6');
        $sidebarOption7 = __('messages.sidebar_option_7');
        $sidebarOption8 = __('messages.sidebar_option_8');

        $profileOption1 = __('messages.profile_option_1');
        $profileOption2 = __('messages.profile_option_2');
        $profileOption3 = __('messages.profile_option_3');
        $profileOption4 = __('messages.profile_option_4');
        $profileOption5 = __('messages.profile_option_5');
        $profileOption6 = __('messages.profile_option_6');

        $pageTitle = __('messages.profile_reset_page_title');
        $metaDescription = __('messages.profile_reset_page_meta_description');
        $profileBasicHeading1 = __('messages.profile_basic_heading_1');

        $profileHeading1 = __('messages.profile_reset_heading_1');
        $resetBtn1 = __('messages.profile_reset_btn_1');

        return view('profile.reset')
            ->with('sidebarOption1', $sidebarOption1)
            ->with('sidebarOption2', $sidebarOption2)
            ->with('sidebarOption3', $sidebarOption3)
            ->with('sidebarOption4', $sidebarOption4)
            ->with('sidebarOption5', $sidebarOption5)
            ->with('sidebarOption6', $sidebarOption6)
            ->with('sidebarOption7', $sidebarOption7)
            ->with('sidebarOption8', $sidebarOption8)
            ->with('profileOption1', $profileOption1)
            ->with('profileOption2', $profileOption2)
            ->with('profileOption3', $profileOption3)
            ->with('profileOption4', $profileOption4)
            ->with('profileOption5', $profileOption5)
            ->with('profileOption6', $profileOption6)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('profileBasicHeading1', $profileBasicHeading1)
            ->with('profileHeading1', $profileHeading1)
            ->with('user', $user)
            ->with('resetBtn1', $resetBtn1)
            ->with('routeUri', $route->uri);
    }

    function storeBasicInfo(Request $request)
    {
        $user = User::find(Auth::id());
        $userDetails = $user->userDetails;
        $userLanguages = $user->languages;

        $rules = array();
        $image = $request->input('user_img');
        $phone = $request->input('phone_num');
        $birthdate = $request->input('birthday');
        $gender = $request->input('gender');
        $languages = $request->input('languages');
        $bio = $request->input('bio');


        $messages = [
            'required' => __('messages.form_error.required')
        ];

        
        $rules['user_img'] = 'nullable|image|max:1024';
        $rules['phone_num'] = 'nullable|max:20';
        $rules['birthday'] = 'nullable|date';
        $rules['gender'] = 'required|integer';
        $rules['bio'] = 'nullable|max:2000';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            // User details birthday
            $birthday = null;

            if(!empty($birthdate)) {
                // Date formatting
                $birthday = Carbon::createFromFormat('d-m-Y', $birthdate)->format('Y-m-d');
            }


            // User details image
            $userImage = null;

            if(!empty($userDetails) && !empty($userDetails->image)) {
                $userImage = $userDetails->image;
            }
            if($request->hasFile('user_img')) {
                $file = $request->file('user_img');
                
                if(!empty($file)) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $picture = sha1($filename . time()) . '.' . $extension;
                    $destinationPath = storage_path() . '/app/public/users/';
                    $file->move($destinationPath, $picture);
                    $destinationUrl = env('APP_URL').'/storage/users/';

                    // Remove previous image
                    if(!empty($userDetails) && !empty($userDetails->image)) {
                        Storage::delete('public/users/'.$userImage);
                    }

                    $userImage = $picture;
                }
            }


            // User details creation
            if(!empty($userDetails)) {
                $userDetails->user_id = Auth::id();
                $userDetails->gender_id = $gender;
                $userDetails->phone = $phone;
                $userDetails->birthday = $birthday;
                $userDetails->description = $bio;
                $userDetails->image = $userImage;
    
                $user->userDetails->save();
            }
            else {
                $userDetail = new UserDetail([
                    'user_id' => Auth::id(),
                    'gender_id' => $gender,
                    'phone' => $phone,
                    'birthday' => $birthday,
                    'description' => $bio,
                    'image' => $userImage,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
    
                $user->userDetails()->save($userDetail);
            }

            

            // User languages
            if(!empty($languages)) {
                $user->languages()->sync($languages);
            }


            // Handling remove image button visibility
            $showRemoveImgBtn = 'no';

            if(!empty($userImage)) {
                $showRemoveImgBtn = 'yes';
            }
        }


        return response()->json([
            'showRemoveImgBtn' => $showRemoveImgBtn,
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function getUserPosition(Request $request)
    {
        $userPositionId = $request->input('position_id');
        $userPosition = UserPosition::find($userPositionId);

        if(!empty($userPosition)) {
            $sDate = Carbon::createFromFormat('Y-m-d H:i:s', $userPosition->start_date);
            $startDate = $sDate->year.', '.$sDate->month;

            $endDate = '';

            if(0 == $userPosition->is_current) {
                $eDate = Carbon::createFromFormat('Y-m-d H:i:s', $userPosition->end_date);
                $endDate = $eDate->year.', '.$eDate->month;
            }
        }


        return response()->json([
            'userPosition' => $userPosition,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    function storeUserPosition(Request $request)
    {   
        $user = User::find(Auth::id());

        $rules = array();
        $id = null;
        $action = $request->input('action');
        $company = $request->input('position_company');
        $location = $request->input('position_location');
        $role = $request->input('position_role');
        $isCurrent = $request->input('is_current');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if('update' == $action) {
            $id = $request->input('id');
        }


        $messages = [
            'required' => __('messages.form_error.required')
        ];


        $startDateRule = 'required|date_format:m-Y|before:end_date';

        if(1 == $isCurrent) {
            $endDate = null;
            $startDateRule = 'required|date_format:m-Y';
        }
        
        $rules['id'] = 'required_if:action,update';
        $rules['action'] = 'required|in:insert,update';
        $rules['position_company'] = 'required|max:150';
        $rules['position_location'] = 'required|max:150';
        $rules['position_role'] = 'required|max:150';
        $rules['start_date'] = $startDateRule;
        $rules['end_date'] = 'required_if:is_current,0|date_format:m-Y|after:start_date';
        $rules['is_current'] = 'required|int';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            if(!empty($endDate)) {
                $endDate = Carbon::createFromFormat('d-m-Y', '01-'.$endDate)->format('Y-m-d');
            }


            if(!empty($action) && !empty($id)) {
                $userPosition = UserPosition::find($id);

                if(!empty($userPosition)) {
                    $userPosition->company_name = $company;
                    $userPosition->city_name = $location;
                    $userPosition->position_name = $role;
                    $userPosition->start_date = Carbon::createFromFormat('d-m-Y', '01-'.$startDate)->format('Y-m-d');
                    $userPosition->end_date = $endDate;
                    $userPosition->is_current = $isCurrent;
                }
            }
            else {
                $userPosition = new UserPosition(
                    ['user_id' => Auth::id(),
                     'company_name' => $company,
                     'position_name' => $role,
                     'city_name' => $location,
                     'start_date' => Carbon::createFromFormat('d-m-Y', '01-'.$startDate)->format('Y-m-d'),
                     'end_date' => $endDate,
                     'is_current' => $isCurrent,
                     'created_at' => date('Y-m-d H:i:s')
                    ]);
            }
            

            $user->positions()->save($userPosition);
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function deleteUserPosition(Request $request)
    {   
        $user = User::find(Auth::id());
        
        $rules = array();
        $userPositionId = $request->input('position_id');


        $messages = [
            'required' => __('messages.form_error.required')
        ];


        $rules['position_id'] = 'required|int';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $position = UserPosition::find($userPositionId);

            if(!empty($position)) {
                $position->delete();
            }
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function getUserStudies(Request $request)
    {
        $userStudiesId = $request->input('studies_id');
        $userStudies = UserStudy::find($userStudiesId);

        return response()->json([
            'userStudies' => $userStudies,
        ]);
    }

    function storeUserStudies(Request $request)
    {   
        $user = User::find(Auth::id());

        $rules = array();
        $id = null;
        $action = $request->input('action');
        $institute = $request->input('institute_name');
        $location = $request->input('institute_location');
        $studies = $request->input('institute_studies');

        if('update' == $action) {
            $id = $request->input('id');
        }


        $messages = [
            'required' => __('messages.form_error.required')
        ];

        
        $rules['id'] = 'required_if:action,update';
        $rules['action'] = 'required|in:insert,update';
        $rules['institute_name'] = 'required|max:150';
        $rules['institute_location'] = 'required|max:150';
        $rules['institute_studies'] = 'required|max:150';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            if(!empty($action) && !empty($id)) {
                $userStudies = UserStudy::find($id);

                if(!empty($userStudies)) {
                    $userStudies->institute_name = $institute;
                    $userStudies->city_name = $location;
                    $userStudies->studies_name = $studies;
                }
            }
            else {
                $userStudies = new UserStudy(
                    ['user_id' => Auth::id(),
                     'institute_name' => $institute,
                     'studies_name' => $studies,
                     'city_name' => $location,
                     'created_at' => date('Y-m-d H:i:s')
                    ]);
            }
            

            $user->studies()->save($userStudies);
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function deleteUserStudies(Request $request)
    {   
        $user = User::find(Auth::id());
        
        $rules = array();
        $userStudiesId = $request->input('studies_id');


        $messages = [
            'required' => __('messages.form_error.required')
        ];


        $rules['studies_id'] = 'required|int';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $studies = UserStudy::find($userStudiesId);

            if(!empty($studies)) {
                $studies->delete();
            }
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function getUserSkill(Request $request)
    {
        $userSkillId = $request->input('skill_id');
        $userSkill = UserSkill::find($userSkillId);

        return response()->json([
            'userSkill' => $userSkill,
        ]);
    }

    function storeUserSkill(Request $request)
    {   
        $user = User::find(Auth::id());

        $rules = array();
        $id = null;
        $action = $request->input('action');
        $skill = $request->input('skill_name');

        if('update' == $action) {
            $id = $request->input('id');
        }


        $messages = [
            'required' => __('messages.form_error.required')
        ];

        
        $rules['id'] = 'required_if:action,update';
        $rules['action'] = 'required|in:insert,update';
        $rules['skill_name'] = 'required|max:100';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            if(!empty($action) && !empty($id)) {
                $userSkill = UserSkill::find($id);

                if(!empty($userSkill)) {
                    $userSkill->skill_name = $skill;
                }
            }
            else {
                $userSkill = new UserSkill(
                    ['user_id' => Auth::id(),
                     'skill_name' => $skill,
                     'created_at' => date('Y-m-d H:i:s')
                    ]);
            }
            

            $user->skills()->save($userSkill);
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function deleteUserSkill(Request $request)
    {   
        $user = User::find(Auth::id());
        
        $rules = array();
        $userSkillId = $request->input('skill_id');


        $messages = [
            'required' => __('messages.form_error.required')
        ];


        $rules['skill_id'] = 'required|int';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $skill = UserSkill::find($userSkillId);

            if(!empty($skill)) {
                $skill->delete();
            }
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function getUserInterest(Request $request)
    {
        $userInterestId = $request->input('interest_id');
        $userInterest = UserInterest::find($userInterestId);

        return response()->json([
            'userInterest' => $userInterest,
        ]);
    }

    function storeUserInterest(Request $request)
    {   
        $user = User::find(Auth::id());

        $rules = array();
        $id = null;
        $action = $request->input('action');
        $interest = $request->input('interest_name');

        if('update' == $action) {
            $id = $request->input('id');
        }


        $messages = [
            'required' => __('messages.form_error.required')
        ];

        
        $rules['id'] = 'required_if:action,update';
        $rules['action'] = 'required|in:insert,update';
        $rules['interest_name'] = 'required|max:100';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            if(!empty($action) && !empty($id)) {
                $userInterest = UserInterest::find($id);

                if(!empty($userInterest)) {
                    $userInterest->interest_name = $interest;
                }
            }
            else {
                $userInterest = new UserInterest(
                    ['user_id' => Auth::id(),
                     'interest_name' => $interest,
                     'created_at' => date('Y-m-d H:i:s')
                    ]);
            }
            

            $user->interests()->save($userInterest);
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function deleteUserInterest(Request $request)
    {   
        $user = User::find(Auth::id());
        
        $rules = array();
        $userInterestId = $request->input('interest_id');


        $messages = [
            'required' => __('messages.form_error.required')
        ];


        $rules['interest_id'] = 'required|int';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $interest = UserInterest::find($userInterestId);

            if(!empty($interest)) {
                $interest->delete();
            }
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function getUserArea(Request $request)
    {
        $userAreaId = $request->input('area_id');
        $userArea = UserArea::find($userAreaId);

        return response()->json([
            'userArea' => $userArea,
        ]);
    }

    function storeUserArea(Request $request)
    {   
        $user = User::find(Auth::id());

        $rules = array();
        $id = null;
        $action = $request->input('action');
        $address = $request->input('address');
        $fullAddress = $request->input('full_address');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        if('update' == $action) {
            $id = $request->input('id');
        }


        $messages = [
            'required' => __('messages.form_error.required')
        ];

        
        $rules['id'] = 'required_if:action,update';
        $rules['action'] = 'required|in:insert,update';
        $rules['address'] = 'required|max:255';
        $rules['full_address'] = 'required';
        $rules['latitude'] = 'required|numeric';
        $rules['longitude'] = 'required|numeric';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $fullAddressArray = json_decode($fullAddress, true);
            $neighbourhood = '';
            $suburb = '';
            $county = '';
            $city = '';
            $state = '';
            $country = '';
            $postcode = '';

            if(is_array($fullAddressArray)) {
                $neighbourhood = isset($fullAddressArray['neighbourhood']) ? $fullAddressArray['neighbourhood'] : '';
                $suburb = isset($fullAddressArray['suburb']) ? $fullAddressArray['suburb'] : '';
                $county = isset($fullAddressArray['county']) ? $fullAddressArray['county'] : '';
                $city = isset($fullAddressArray['city']) ? $fullAddressArray['city'] : '';
                $state = isset($fullAddressArray['state']) ? $fullAddressArray['state'] : '';
                $country = isset($fullAddressArray['country']) ? $fullAddressArray['country'] : '';
                $postcode = isset($fullAddressArray['postcode']) ? $fullAddressArray['postcode'] : '';
            }



            if(!empty($action) && !empty($id)) {
                $userArea = UserArea::find($id);

                if(!empty($userArea)) {
                    $userArea->address = $address;
                    $userArea->neighbourhood = $neighbourhood;
                    $userArea->suburb = $suburb;
                    $userArea->county = $county;
                    $userArea->city = $city;
                    $userArea->state = $state;
                    $userArea->country = $country;
                    $userArea->postcode = $postcode;
                    $userArea->latitude = $latitude;
                    $userArea->longitude = $longitude;
                }
            }
            else {
                $userArea = new UserArea(
                    ['user_id' => Auth::id(),
                     'address' => $address,
                     'neighbourhood' => $neighbourhood,
                     'suburb' => $suburb,
                     'county' => $county,
                     'city' => $city,
                     'state' => $state,
                     'country' => $country,
                     'postcode' => $postcode,
                     'latitude' => $latitude,
                     'longitude' => $longitude,
                     'created_at' => date('Y-m-d H:i:s')
                    ]);
            }
            

            $user->areas()->save($userArea);
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function deleteUserArea(Request $request)
    {   
        $user = User::find(Auth::id());
        
        $rules = array();
        $userAreaId = $request->input('area_id');


        $messages = [
            'required' => __('messages.form_error.required')
        ];


        $rules['area_id'] = 'required|int';
        

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $area = UserArea::find($userAreaId);

            if(!empty($area)) {
                $area->delete();
            }
        }


        return response()->json([
            'message' => __('messages.profile_form_success.stored')
        ]);
    }

    function imageRemove(Request $request)
	{
        $user = User::find(Auth::id());
        $userDetails = $user->userDetails;


        if(!empty($userDetails) && !empty($userDetails->image)) {
            Storage::delete('public/users/'.$userDetails->image);
            $userDetails->image = '';

            $user->userDetails->save();
        }


        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
	}

    function getFileSize($filePath, $clearStatCache = false)
    {
		if($clearStatCache) {
			if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
				clearstatcache(true, $filePath);
			} else {
				clearstatcache();
			}
		}

		return $this->fixIntegerOverflow(filesize($filePath));
	}

    function fixIntegerOverflow($size)
    {
		if ($size < 0) {
			$size += 2.0 * (PHP_INT_MAX + 1);
		}
        
		return $size;
	}
}
