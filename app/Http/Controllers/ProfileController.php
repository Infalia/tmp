<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller
{
    function basicInfo()
    {
        $route = Route::current();
        $user = null;

        if(session()->has('user')) {
            $user = session('user');
        }

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

        $emailLbl = __('messages.form_email_lbl');
        $emailPldr = __('messages.form_email_pldr');
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
            ->with('emailLbl', $emailLbl)
            ->with('emailPldr', $emailPldr)
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

        $socialBtnFb = __('messages.profile_social_accounts_btn', ['socialNetwork' => 'Facebook', 'isLinked' => (1==1 ? '' : 'not')]);
        $socialBtnGgl = __('messages.profile_social_accounts_btn', ['socialNetwork' => 'Google', 'isLinked' => (1==2 ? '' : 'not')]);
        $socialBtnPint = __('messages.profile_social_accounts_btn', ['socialNetwork' => 'Pinterest', 'isLinked' => (1==2 ? '' : 'not')]);
        $socialBtnLin = __('messages.profile_social_accounts_btn', ['socialNetwork' => 'LinkedIn', 'isLinked' => (1==2 ? '' : 'not')]);

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
            ->with('socialBtnFb', $socialBtnFb)
            ->with('socialBtnGgl', $socialBtnGgl)
            ->with('socialBtnPint', $socialBtnPint)
            ->with('socialBtnLin', $socialBtnLin)

            ->with('routeUri', $route->uri);
    }


    function resetData()
    {
        $route = Route::current();
        $user = null;

        if(session()->has('user')) {
            $user = session('user');
        }

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



    function socialData()
    {
        $route = Route::current();
        $user = null;

        if(session()->has('user')) {
            $user = session('user');
        }

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

        $pageTitle = __('messages.profile_basic_page_title');
        $metaDescription = __('messages.profile_basic_page_meta_description');
        $profileBasicHeading1 = __('messages.profile_basic_heading_1');

        return view('profile.social-data')
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
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('profileBasicHeading1', $profileBasicHeading1)
            ->with('user', $user)
            ->with('routeUri', $route->uri);
    }
}
