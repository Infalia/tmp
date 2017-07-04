<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\InitiativeType;
use App\Initiative;
use App\InitiativeImage;
use App\Helpers\OnToMap;
use Carbon\Carbon;
//use DateTime;

class InitiativeController extends Controller
{
    function initiatives()
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

        $pageTitle = __('messages.initiatives_page_title');
        $metaDescription = __('messages.initiatives_page_meta_description');
        $commentLbl = __('messages.timeline_comment_lbl');
        $supportLbl = __('messages.timeline_supporter_lbl');
        $showBtn = __('messages.initiatives_btn_1');
        $noRecordsMsg = __('messages.initiatives_msg_1');


        $initiatives = Initiative::all();
        

        return view('initiatives.initiatives')
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
            ->with('commentLbl', $commentLbl)
            ->with('supportLbl', $supportLbl)
            ->with('showBtn', $showBtn)
            ->with('noRecordsMsg', $noRecordsMsg)
            ->with('initiatives', $initiatives)
            ->with('routeUri', $route->uri);
    }



    function initiative($id)
    {
	$route = Route::current();        $initiative = Initiative::find($id);        $sidebarOption1 = __('messages.sidebar_option_1');        $sidebarOption2 = __('messages.sidebar_option_2');        $sidebarOption3 = __('messages.sidebar_option_3');        $sidebarOption4 = __('messages.sidebar_option_4');        $sidebarOption5 = __('messages.sidebar_option_5');        $sidebarOption6 = __('messages.sidebar_option_6');        $sidebarOption7 = __('messages.sidebar_option_7');        $sidebarOption8 = __('messages.sidebar_option_8');        $pageTitle = $initiative->title;        $metaDescription = '';        $commentLbl = __('messages.timeline_comment_lbl');        $supportLbl = __('messages.timeline_supporter_lbl');        $showBtn = __('messages.initiatives_btn_1');        $noRecordsMsg = __('messages.initiatives_msg_1');               return view('initiatives.initiative')            ->with('sidebarOption1', $sidebarOption1)            ->with('sidebarOption2', $sidebarOption2)            ->with('sidebarOption3', $sidebarOption3)            ->with('sidebarOption4', $sidebarOption4)            ->with('sidebarOption5', $sidebarOption5)            ->with('sidebarOption6', $sidebarOption6)            ->with('sidebarOption7', $sidebarOption7)            ->with('sidebarOption8', $sidebarOption8)            ->with('pageTitle', $pageTitle)            ->with('metaDescription', $metaDescription)            ->with('commentLbl', $commentLbl)            ->with('supportLbl', $supportLbl)            ->with('showBtn', $showBtn)            ->with('noRecordsMsg', $noRecordsMsg)            ->with('initiative', $initiative)            ->with('routeUri', $route->uri);
    }

    function initiativeForm()
    {
        $initiativeType = new InitiativeType();
        $route = Route::current();

        $initiativeTypes = $initiativeType->all();

        $sidebarOption1 = __('messages.sidebar_option_1');
        $sidebarOption2 = __('messages.sidebar_option_2');
        $sidebarOption3 = __('messages.sidebar_option_3');
        $sidebarOption4 = __('messages.sidebar_option_4');
        $sidebarOption5 = __('messages.sidebar_option_5');
        $sidebarOption6 = __('messages.sidebar_option_6');
        $sidebarOption7 = __('messages.sidebar_option_7');
        $sidebarOption8 = __('messages.sidebar_option_8');

        $pageTitle = __('messages.initiative_form_page_title');
        $metaDescription = __('messages.initiative_form_page_meta_description');
        $initiativeFormHeading1 = __('messages.initiative_form_heading_1');
        $typeLbl = __('messages.form_init_type_lbl');
        $typePldr = __('messages.form_init_type_pldr');
        $titleLbl = __('messages.form_init_title_lbl');
        $titlePldr = __('messages.form_init_title_pldr');
        $startDateLbl = __('messages.form_start_date_lbl');
        $startDatePldr = __('messages.form_start_date_pldr');
        $endDateLbl = __('messages.form_end_date_lbl');
        $endDatePldr = __('messages.form_end_date_pldr');
        $descriptionLbl = __('messages.form_init_descr_lbl');
        $descriptionPldr = __('messages.form_init_descr_pldr');
        $imageUploadFileSizeMsg = __('messages.initiative_form_image_msg_1');
        $imageUploadErrorMsg = __('messages.initiative_form_image_msg_2');
        $imageUploadFileTypeMsg = __('messages.initiative_form_image_msg_3');
        $imageUploadFileNumberMsg = __('messages.initiative_form_image_msg_4');
        $removeImageBtn = __('messages.initiative_form_image_btn_1');
        $saveBtn = __('messages.form_save_btn');
        $cancelBtn = __('messages.form_cancel_btn');


        return view('initiatives.initiative-form')
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
            ->with('initiativeFormHeading1', $initiativeFormHeading1)
            ->with('initiativeTypes', $initiativeTypes)
            ->with('typeLbl', $typeLbl)
            ->with('typePldr', $typePldr)
            ->with('titleLbl', $titleLbl)
            ->with('titlePldr', $titlePldr)
            ->with('startDateLbl', $startDateLbl)
            ->with('startDatePldr', $startDatePldr)
            ->with('endDateLbl', $endDateLbl)
            ->with('endDatePldr', $endDatePldr)
            ->with('descriptionLbl', $descriptionLbl)
            ->with('descriptionPldr', $descriptionPldr)
            ->with('imageUploadFileSizeMsg', $imageUploadFileSizeMsg)
            ->with('imageUploadErrorMsg', $imageUploadErrorMsg)
            ->with('imageUploadFileTypeMsg', $imageUploadFileTypeMsg)
            ->with('imageUploadFileNumberMsg', $imageUploadFileNumberMsg)
            ->with('removeImageBtn', $removeImageBtn)
            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn)
            ->with('routeUri', $route->uri);
    }

    function storeInitiative(Request $request)
    {
        $rules = array();
        $initiativeType = $request->input('initiative_type');
        $title = $request->input('title');
        $date = $request->input('date');
        $description = $request->input('description');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $inputMapData = $request->input('input_map_data');
        $lastInsertedId = null;


        $messages = [
            'required' => __('messages.initiative_form_error.required')
        ];

        
        $rules['initiative_type'] = 'required|integer';
        $rules['title'] = 'required|max:255';
        $rules['date'] = 'required';
        $rules['description'] = 'required';
        $rules['latitude'] = 'required|numeric';
        $rules['longitude'] = 'required|numeric';
        

        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()) {
            // $err = $validator->messages();

            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $user = new User();

            // Date formatting
            $dateArr = explode(' to ', $date);
            $startDate = $dateArr[0];
            $endDate = $dateArr[1];

            $startDate = Carbon::createFromFormat('d/m/Y H:i:s', $startDate.':00')->format('Y-m-d H:i:s');
            $endDate = Carbon::createFromFormat('d/m/Y H:i:s', $endDate.':00')->format('Y-m-d H:i:s');


            $initiative = new Initiative(
                ['initiative_type_id' => $initiativeType,
                 'title' => $title,
                 'description' => $description,
                 'latitude' => $latitude,
                 'longitude' => $longitude,
                 'input_map_data' => $inputMapData,
                 'start_date' => $startDate,
                 'end_date' => $endDate,
                 'created_at' => date('Y-m-d H:i:s')
                ]);


            $isInserted = $user->find(Auth::id())->initiatives()->save($initiative);

            if($isInserted) {
                $lastInsertedId = $initiative->id;
            }
        }


        return response()->json([
            'initId' => $lastInsertedId,
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }

    function imageUpload(Request $request)
	{
        $initiative = new Initiative();
        $initiativeId = $request->input('initId');
        $images = array();


        if($request->hasFile('files')) {
            $file = $request->file('files');
            
            foreach($file as $files) {
                $filename = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $picture = sha1($filename . time()) . '.' . $extension;
                $destinationPath = storage_path() . '/app/public/initiatives/';
                $files->move($destinationPath, $picture);
                $destinationUrl = env('APP_URL').'/storage/initiatives/';
                
                // Add image urls to array
                $images[] = $picture;


                $initiativeImage = new InitiativeImage(
                    ['name' => $picture,
                     'url' => $destinationUrl.$picture,
                     'size' => $this->getFileSize($destinationPath.$picture),
                     'created_at' => date('Y-m-d H:i:s')
                    ]);

                $isInserted = $initiative->find($initiativeId)->initiativeImages()->save($initiativeImage);
            }

            return response()->json([
                'files' => $images,
                'message' => __('messages.initiative_form_success.stored')
            ]);
		}
	}

    function postToOnToMap(Request $request)
	{
        $initiative = new Initiative();
        $initiativeId = $request->input('initId');
        $images = $request->input('images');

        $currentInitiative = $initiative->find($initiativeId);


        if(!empty($currentInitiative)) {
            // OnToMap request
            $onToMap = new OnToMap();

            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => $currentInitiative->user_id,
                    'timestamp' => time(),
                    'activity_type' => 'object_created',
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($currentInitiative->longitude), floatval($currentInitiative->latitude))
                            ),
                            'properties' => array(
                                'hasType' => 'ChildCare',
                                'external_url' => env('APP_URL').'/offer/'.$initiativeId.'/'.str_slug($currentInitiative->title),
                                'name' => $currentInitiative->title,
                                'additionalProperties' => array(
                                    'initiative_type' => $currentInitiative->initiativeType->name,
                                    'description' => $currentInitiative->description,
                                    'input_map_data' => $currentInitiative->input_map_data,
                                    'start_date' => $currentInitiative->start_date,
                                    'end_date' => $currentInitiative->end_date,
                                    'images' => $images,
                                    'tmp_id' => $initiativeId
                                )
                            )
                        )
                    )
                )
            ));

            $onToMap->postEvent($eventList);
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
