<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Helpers\OnToMap;

class TimelineController extends Controller
{
    function index()
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

        $pageTitle = __('messages.timeline_page_title');
        $metaDescription = __('messages.timeline_page_meta_description');
        $postedOfferLbl = __('messages.timeline_offer_posted_lbl');
        $postedDemandLbl = __('messages.timeline_demand_posted_lbl');
        $postedIssueLbl = __('messages.timeline_issue_posted_lbl');
        $postedCommentLbl = __('messages.timeline_comment_posted_lbl');
        $postedInitiativeLbl = __('messages.timeline_initiative_posted_lbl');
        $commentLbl = __('messages.timeline_comment_lbl');
        $supportLbl = __('messages.timeline_supporter_lbl');
        $noRecordsMsg = __('messages.timeline_msg_1');



        $ontomap = new OnToMap();
        $userEvents = null;
        $params = array('actor' => Auth::id());
        $userEvents = json_decode($ontomap->getEvents($params), true);


        // if(!empty($userEvents)) {
        //     $i = 0;
            
        //     foreach($userEvents['event_list'] as $event) {
        //         $totalSupporters = 0;

        //         if(isset($event['references'][0]['external_url'])) {
        //             $params = array('reference_external_url' => $event['references'][0]['external_url']);
        //             $supporters = json_decode($ontomap->getEvents($params), true);
        //             $totalSupporters = count($supporters);
        //         }
                
        //         $userEvents['event_list'][$i]['total_suporters'] = $totalSupporters;
        //         $i++;
        //     }
        // }

        
        // echo '<pre>';
        // print_r($userEvents);
        // echo '</pre>';


        return view('timeline.index')
            ->with('sidebarOption1', $sidebarOption1)
            ->with('sidebarOption2', $sidebarOption2)
            ->with('sidebarOption3', $sidebarOption3)
            ->with('sidebarOption4', $sidebarOption4)
            ->with('sidebarOption5', $sidebarOption5)
            ->with('sidebarOption6', $sidebarOption6)
            ->with('sidebarOption7', $sidebarOption7)
            ->with('sidebarOption8', $sidebarOption8)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('postedOfferLbl', $postedOfferLbl)
            ->with('postedDemandLbl', $postedDemandLbl)
            ->with('postedIssueLbl', $postedIssueLbl)
            ->with('postedCommentLbl', $postedCommentLbl)
            ->with('postedInitiativeLbl', $postedInitiativeLbl)
            ->with('commentLbl', $commentLbl)
            ->with('supportLbl', $supportLbl)
            ->with('noRecordsMsg', $noRecordsMsg)
            ->with('userEvents', $userEvents)
            ->with('user', $user)
            ->with('routeUri', $route->uri);
    }
}
