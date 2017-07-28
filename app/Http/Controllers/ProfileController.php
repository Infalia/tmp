<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\UserDetail;
use App\Gender;
use App\Language;
use App\SocialNetwork;
use Carbon\Carbon;

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

    function work()
    {
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
        $profileAddBtn1 = __('messages.profile_work_add_btn_1');
        $profileAddBtn2 = __('messages.profile_work_add_btn_2');
        $profileAddBtn3 = __('messages.profile_work_add_btn_3');
        $profileFormCompanyLbl = __('messages.profile_form_company_lbl');
        $profileFormInstituteLbl = __('messages.profile_form_institute_lbl');
        $profileFormCityLbl = __('messages.profile_form_city_lbl');
        $profileFormRoleLbl = __('messages.profile_form_role_lbl');
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
            ->with('profileAddBtn1', $profileAddBtn1)
            ->with('profileAddBtn2', $profileAddBtn2)
            ->with('profileAddBtn3', $profileAddBtn3)
            ->with('profileFormCompanyLbl', $profileFormCompanyLbl)
            ->with('profileFormInstituteLbl', $profileFormInstituteLbl)
            ->with('profileFormCityLbl', $profileFormCityLbl)
            ->with('profileFormRoleLbl', $profileFormRoleLbl)
            ->with('profileFormFromLbl', $profileFormFromLbl)
            ->with('profileFormToLbl', $profileFormToLbl)
            ->with('profileFormStudiesLbl', $profileFormStudiesLbl)
            ->with('profileFormSkillLbl', $profileFormSkillLbl)

            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn)
            ->with('routeUri', $route->uri);
    }

    function interests()
    {
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
            ->with('profileFormInterestLbl', $profileFormInterestLbl)
            ->with('profileFormAreaLbl', $profileFormAreaLbl)

            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn)
            ->with('routeUri', $route->uri);
    }

    function socialAccounts()
    {
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
            ->with('socialNetworks', $socialNetworks)
            ->with('userSocialNetworks', $userSocialNetworks)
            ->with('routeUri', $route->uri);
    }

    function resetData()
    {
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
            ->with('resetBtn1', $resetBtn1)
            ->with('user', $user)
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
            $createdAt = date('Y-m-d H:i:s');

            if(!empty($userDetails) && !empty($userDetails->created_at)) {
                $createdAt = $userDetails->created_at;
            }

            

            $userDetails->user_id = Auth::id();
            $userDetails->gender_id = $gender;
            $userDetails->phone = $phone;
            $userDetails->birthday = $birthday;
            $userDetails->description = $bio;
            $userDetails->image = $userImage;
            $userDetails->created_at = $createdAt;

            $user->userDetails->save();

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
            'message' => __('messages.initiative_form_success.stored')
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
}
