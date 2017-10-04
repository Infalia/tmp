<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\AccessbltyCat;
use App\User;


class AccessibilityController extends Controller
{
    function index()
    {
        $user = User::find(Auth::id());
        $accessibilityCategory = new AccessbltyCat();
        $route = Route::current();


        // // To use this package, first we need an instance of our model
        // $greek = $accessibilityCategory->where('id', 1)->first();
        // $greek->setDefaultLocale('el');
        // $translation = $greek->translate();

        $accessibilityCats = $accessibilityCategory->all();

        $userAccessibilityOpts = array();

        if(session()->has('user.accessibility_opts')) {
            $userAccessibilityOpts = session('user.accessibility_opts');
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

        $pageTitle = __('messages.accessibility_page_title');
        $metaDescription = __('messages.accessibility_page_meta_description');
        $heading1 = __('messages.accessibility_heading_1');
        $saveBtn = __('messages.form_save_btn');
        $radioBtnValidationMsg = __('messages.accessibility_radio_error.required'); // A generic error message for each radio button group


        return view('accessibility.index')
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
            ->with('heading1', $heading1)
            ->with('saveBtn', $saveBtn)
            ->with('radioBtnValidationMsg', $radioBtnValidationMsg)
            ->with('routeUri', $route->uri)
            ->with('accessibilityCats', $accessibilityCats)
            ->with('userAccessibilityOpts', $userAccessibilityOpts)
            ->with('user', $user);
    }

    function storeUserAccessibilityOptions(Request $request) {
        $rules = array();
        $radioGroups = $request->input('radio_groups');

        /*
         * At the moment, this validation message is useless, because it's not possible to know
         * the name attribute of each radio button group (because names are given dynamically)
         *
         */
        $messages = [
            'required' => __('messages.accessibility_radio_error.required'),
        ];

        foreach ($radioGroups as $radioGroup) {
            $rules[$radioGroup] = 'required';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json([
                'errors' => $messages
            ]);
        }
        else {
            $user = new User();
            $options = $request->input('options');
            $user->find(Auth::id())->accessibilityOptions()->sync($options);

            $request->session()->put('user.accessibility_opts', $options);

            return response()->json([
                'message' => __('messages.accessibility_radio_success.stored'),
            ]);
        }
    }
}
