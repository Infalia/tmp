<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $pageTitle = __('messages.home_page_title');
        $metaDescription = __('messages.home_page_meta_description');
        $heading1 = __('messages.home_heading_1');
        $heading2 = __('messages.home_heading_2');
        $listOption1 = __('messages.home_list_1_option_1');
        $listOption2 = __('messages.home_list_1_option_2');
        $listOption3 = __('messages.home_list_1_option_3');
        $listOption4 = __('messages.home_list_1_option_4');
        $alert1 = __('messages.home_alert_1');
        $alert2 = __('messages.home_alert_2');
        $socialBtnFb = __('messages.home_social_btn', ['socialNetwork' => 'Facebook']);
        $socialBtnGgl = __('messages.home_social_btn', ['socialNetwork' => 'Google']);
        $socialBtnPint = __('messages.home_social_btn', ['socialNetwork' => 'Pinterest']);
        $socialBtnLin = __('messages.home_social_btn', ['socialNetwork' => 'LinkedIn']);
        $socialBtnTw = __('messages.home_social_btn', ['socialNetwork' => 'Twitter']);

	    return view('home.index')
            ->with('pageTitle', $pageTitle)
	        ->with('metaDescription', $metaDescription)
            ->with('heading1', $heading1)
            ->with('heading2', $heading2)
            ->with('listOption1', $listOption1)
            ->with('listOption2', $listOption2)
            ->with('listOption3', $listOption3)
            ->with('listOption4', $listOption4)
            ->with('alert1', $alert1)
            ->with('alert2', $alert2)
            ->with('socialBtnFb', $socialBtnFb)
            ->with('socialBtnGgl', $socialBtnGgl)
            ->with('socialBtnPint', $socialBtnPint)
            ->with('socialBtnLin', $socialBtnLin)
            ->with('socialBtnTw', $socialBtnTw);
    }
}
