<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\AccessbltyCat;
use App\User;


class AccessibilityController extends Controller
{
    function index()
    {
        $user = new User();
        $accessibilityCategory = new AccessbltyCat();
        $route = Route::current();


        // // To use this package, first we need an instance of our model
        // $greek = $accessibilityCategory->where('id', 1)->first();
        // $greek->setDefaultLocale('el');
        // $translation = $greek->translate();

        $accessibilityCats = $accessibilityCategory->all();
        //$user = $user->find(1);

        $userAccessibilityOpts = array();

        if(session()->has('user.accessibility_opts')) {
            $userAccessibilityOpts = session('user.accessibility_opts');
        }


        $pageTitle = __('messages.accessibility_page_title');
        $metaDescription = __('messages.accessibility_page_meta_description');
        $heading1 = __('messages.accessibility_heading_1');
        $saveBtn = __('messages.form_save_btn');
        $radioBtnValidationMsg = __('messages.accessibility_radio_error.required'); // A generic error message for each radio button group


        return view('accessibility.index')
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('heading1', $heading1)
            ->with('saveBtn', $saveBtn)
            ->with('radioBtnValidationMsg', $radioBtnValidationMsg)
            ->with('routeUri', $route->uri)
            ->with('accessibilityCats', $accessibilityCats)
            ->with('userAccessibilityOpts', $userAccessibilityOpts);
            //->with('user', $user);
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
            $user->find(1)->accessibilityOptions()->sync($options);

            $request->session()->put('user.accessibility_opts', $options);

            return response()->json([
                'message' => __('messages.accessibility_radio_success.stored'),
            ]);
        }
    }
}
