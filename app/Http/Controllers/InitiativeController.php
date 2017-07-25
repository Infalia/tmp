<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\User;
use App\InitiativeType;
use App\Initiative;
use App\InitiativeImage;
use App\Comment;
use App\Helpers\OnToMap;
use Carbon\Carbon;

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
        $editBtn = __('messages.form_edit_btn');
        $noRecordsMsg = __('messages.initiatives_msg_1');


        $initiatives = Initiative::all()->sortBy('start_date');
        

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
            ->with('editBtn', $editBtn)
            ->with('noRecordsMsg', $noRecordsMsg)
            ->with('initiatives', $initiatives)
            ->with('routeUri', $route->uri);
    }

    function initiative($id)
    {
        try {
            $initiative = Initiative::findOrFail($id);

            $route = Route::current();

            $sidebarOption1 = __('messages.sidebar_option_1');
            $sidebarOption2 = __('messages.sidebar_option_2');
            $sidebarOption3 = __('messages.sidebar_option_3');
            $sidebarOption4 = __('messages.sidebar_option_4');
            $sidebarOption5 = __('messages.sidebar_option_5');
            $sidebarOption6 = __('messages.sidebar_option_6');
            $sidebarOption7 = __('messages.sidebar_option_7');
            $sidebarOption8 = __('messages.sidebar_option_8');
            
            
            $pageTitle = $initiative->title;
            $metaDescription = '';
            $commentLbl = __('messages.timeline_comment_lbl');
            $supportLbl = __('messages.timeline_supporter_lbl');
            $showBtn = __('messages.initiatives_btn_1');
            $supportBtn = __('messages.initiatives_btn_3');
            $commentAddPldr = __('messages.form_comments_add_pldr');
            $commentReplyBtn = __('messages.form_comments_reply_btn');
            $commentViewRepliesBtn = __('messages.form_comments_view_replies_btn');
            $commentHideRepliesBtn = __('messages.form_comments_hide_replies_btn');
            $noCommentsMsg = __('messages.form_no_comments_msg');
            $commentAddBtn = __('messages.form_comments_post_btn');
            $editBtn = __('messages.form_edit_btn');
            $deleteBtn = __('messages.form_delete_btn');
            $noRecordsMsg = __('messages.initiatives_msg_1');

            return view('initiatives.initiative')
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
                ->with('supportBtn', $supportBtn)
                ->with('commentAddPldr', $commentAddPldr)
                ->with('commentReplyBtn', $commentReplyBtn)
                ->with('commentViewRepliesBtn', $commentViewRepliesBtn)
                ->with('commentHideRepliesBtn', $commentHideRepliesBtn)
                ->with('noCommentsMsg', $noCommentsMsg)
                ->with('commentAddBtn', $commentAddBtn)
                ->with('editBtn', $editBtn)
                ->with('deleteBtn', $deleteBtn)
                ->with('noRecordsMsg', $noRecordsMsg)
                ->with('initiative', $initiative)
                ->with('initiativeId', $id)
                ->with('routeUri', $route->uri);

        } catch(ModelNotFoundException $e) {
            return redirect(url('404'));
        }
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
        $removeImageBtn = __('messages.form_remove_btn');
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

    function initiativeEditForm($id)
    {
        try {
            $initiative = Initiative::findOrFail($id);
            $initiativeTypes = InitiativeType::all();
            $route = Route::current();

            $initiativeTypeId = $initiative->initiative_type_id;
            $initiativeTitle = $initiative->title;
            $initiativeDescription = $initiative->description;
            $initiativeLatitude = $initiative->latitude;
            $initiativeLongitude = $initiative->longitude;

            $initStartDate = Carbon::createFromFormat('Y-m-d H:i:s', $initiative->start_date);
            $initEndDate = Carbon::createFromFormat('Y-m-d H:i:s', $initiative->end_date);
            $initiativeStartDate = $initStartDate->year.', '.($initStartDate->month-1).', '.$initStartDate->day.', '.$initStartDate->hour.', '.$initStartDate->minute.', '.$initStartDate->second;
            $initiativeEndDate = $initEndDate->year.', '.($initEndDate->month-1).', '.$initEndDate->day.', '.$initEndDate->hour.', '.$initEndDate->minute.', '.$initEndDate->second;



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
            $initiativeFormHeading1 = __('messages.initiative_form_heading_2');
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
            $removeImageBtn = __('messages.form_remove_btn');
            $saveBtn = __('messages.form_save_btn');
            $cancelBtn = __('messages.form_cancel_btn');


            return view('initiatives.initiative-edit-form')
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
                ->with('initiative', $initiative)
                ->with('initiativeTypeId', $initiativeTypeId)
                ->with('initiativeTitle', $initiativeTitle)
                ->with('initiativeDescription', $initiativeDescription)
                ->with('initiativeLatitude', $initiativeLatitude)
                ->with('initiativeLongitude', $initiativeLongitude)
                ->with('initiativeStartDate', $initiativeStartDate)
                ->with('initiativeEndDate', $initiativeEndDate)
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
        } catch(ModelNotFoundException $e) {
            return redirect(url('404'));
        }
    }

    function initiativeComments(Request $request)
    {
        $initiativeId = $request->input('init_id');
        $comments = Initiative::find($initiativeId)->comments;

        return response()->json($comments);
    }

    function storeInitiative(Request $request)
    {
        $rules = array();
        $initiativeType = $request->input('initiative_type');
        $title = $request->input('title');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
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
        $rules['start_date'] = 'required|date|before:end_date';
        $rules['end_date'] = 'required|date|after:start_date';
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
            // Date formatting
            $startDate = Carbon::createFromFormat('d-m-Y H:i:s', $startDate.':00')->format('Y-m-d H:i:s');
            $endDate = Carbon::createFromFormat('d-m-Y H:i:s', $endDate.':00')->format('Y-m-d H:i:s');


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


            $isInserted = User::find(Auth::id())->initiatives()->save($initiative);

            if($isInserted) {
                $lastInsertedId = $initiative->id;
            }
        }


        return response()->json([
            'initId' => $lastInsertedId,
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }

    function updateInitiative($id, Request $request)
    {
        $rules = array();
        $initiativeId = $id;
        $initiativeType = $request->input('initiative_type');
        $title = $request->input('title');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $description = $request->input('description');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $inputMapData = $request->input('input_map_data');


        $messages = [
            'required' => __('messages.initiative_form_error.required')
        ];

        
        $rules['initiative_type'] = 'required|integer';
        $rules['title'] = 'required|max:255';
        $rules['start_date'] = 'required|date|before:end_date';
        $rules['end_date'] = 'required|date|after:start_date';
        $rules['description'] = 'required';
        // $rules['latitude'] = 'required|numeric';
        // $rules['longitude'] = 'required|numeric';
        

        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()) {
            // $err = $validator->messages();

            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            // Date formatting
            $startDate = Carbon::createFromFormat('d-m-Y H:i:s', $startDate.':00')->format('Y-m-d H:i:s');
            $endDate = Carbon::createFromFormat('d-m-Y H:i:s', $endDate.':00')->format('Y-m-d H:i:s');

            $initiative = Initiative::find($initiativeId);
            $initiative->initiative_type_id = $initiativeType;
            $initiative->title = $title;
            $initiative->description = $description;
            if(!empty($latitude)) $initiative->latitude = $latitude;
            if(!empty($longitude)) $initiative->longitude = $longitude;
            if(!empty($inputMapData)) $initiative->input_map_data = $inputMapData;
            $initiative->start_date = $startDate;
            $initiative->end_date = $endDate;


            $isUpdated = $initiative->save();
        }


        return response()->json([
            'initId' => $initiativeId,
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }

    function deleteInitiative($id)
    {
        $initiativeId = $id;
        $initiativeImages = array();


        $initiative = Initiative::find($initiativeId);

        if(!empty($initiative->images)) {
            $initiativeImages = $initiative->images;
        }
        
        $isDeleted = $initiative->delete();

        if($isDeleted) {
            foreach($initiativeImages as $image) {
                Storage::delete('public/initiatives/'.$image->name);
            }
        }

        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }

    function storeInitiativeSupporter(Request $request)
    {
        $initiativeId = $request->input('initiative_id');
        $initiative = Initiative::find($initiativeId);
        $totalSupporters = 0;

        $isUserSupporting = $initiative->users->contains('id', Auth::id());

        if($isUserSupporting) {
            $initiative->users()->detach(Auth::id());
        }
        else {
            $initiative->users()->attach(Auth::id(), ['created_at' => date('Y-m-d H:i:s')]);
        }

        $initiative = Initiative::find($initiativeId);
        $totalSupporters = $initiative->users->count();


        return response()->json([
            'totalSupporters' => $totalSupporters
        ]);
    }

    function storeInitiativeComment(Request $request)
    {
        $rules = array();
        $commentId = $request->input('parent_id');
        $initiativeId = $request->input('init_id');
        $userId = Auth::id();
        $userFullname = User::find(Auth::id())->name;
        $body = $request->input('body');

        $initiative = new Initiative();
        $totalComments = $initiative->find($initiativeId)->comments->count();


        $messages = [
            'required' => __('messages.initiative_form_error.required')
        ];
        
        $rules['init_id'] = 'required|integer';
        $rules['body'] = 'required';
        
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $comment = new Comment([
                'parent_id' => $commentId,
                'user_id' => $userId,
                'user_fullname' => $userFullname,
                'body' => $body,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $initiative->find($initiativeId)->comments()->save($comment);
            $totalComments = $initiative->find($initiativeId)->comments->count();
        }


        return response()->json([
            'total_comments' => $totalComments
        ]);
    }

    function imageUpload(Request $request)
	{
        $initiative = new Initiative();
        $initiativeId = $request->input('initId');
        $images = array();


        if($request->hasFile('files')) {
            $files = $request->file('files');
            
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = sha1($filename . time()) . '.' . $extension;
                $destinationPath = storage_path() . '/app/public/initiatives/';
                $file->move($destinationPath, $picture);
                $destinationUrl = env('APP_URL').'/storage/initiatives/';
                
                // Add image urls to array
                $images[] = $picture;


                $initiativeImage = new InitiativeImage(
                    ['name' => $picture,
                     'url' => $destinationUrl.$picture,
                     'size' => $this->getFileSize($destinationPath.$picture),
                     'created_at' => date('Y-m-d H:i:s')
                    ]);

                $isInserted = $initiative->find($initiativeId)->images()->save($initiativeImage);
            }

            return response()->json([
                'files' => $images,
                'message' => __('messages.initiative_form_success.stored')
            ]);
		}
	}

    function imageRemove(Request $request)
	{
        $initiativeId = $request->input('init_id');
        $imageId = $request->input('image_id');
        $initImages = array();

        
        $initiativeImage = InitiativeImage::find($imageId);

        if(!empty($initiativeImage)) {
            $imageName = $initiativeImage->name;
            $isDeleted = $initiativeImage->delete();

            if($isDeleted) {
                Storage::delete('public/initiatives/'.$imageName);
            }
        }


        $initiativeImages = Initiative::find($initiativeId)->images;

        $counter = 0;
        foreach($initiativeImages as $image) {
            $initImages[$counter] = array('id' => $image->id, 'name' => $image->name);

            $counter++;
        }


        return response()->json([
            'initImages' => $initImages
        ]);
	}

    function storeOnToMap(Request $request)
	{
        $initiativeId = $request->input('initId');
        $images = $request->input('images');

        $initiative = Initiative::find($initiativeId);


        if(!empty($initiative)) {
            $initiativeType = 'Offer';

            if($initiative->initiative_type_id == 2) {
                $initiativeType = 'Demand';
            }

            // OnToMap request
            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => $initiative->user_id,
                    'timestamp' => round(microtime(true) * 1000),
                    'activity_type' => 'object_created',
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($initiative->longitude), floatval($initiative->latitude))
                            ),
                            'properties' => array(
                                'hasID' => $initiative->id,
                                'hasType' => $initiativeType,
                                'hasName' => $initiative->title,
                                'hasDescription' => $initiative->description,
                                'external_url' => env('APP_URL').'/offer/'.$initiativeId.'/'.str_slug($initiative->title),
                                'name' => $initiative->title,
                                'additionalProperties' => array(
                                    // 'initiative_type' => $initiative->initiativeType->name,
                                    // 'description' => $initiative->description,
                                    'input_map_data' => $initiative->input_map_data,
                                    'start_date' => $initiative->start_date,
                                    'end_date' => $initiative->end_date,
                                    'images' => $images
                                )
                            )
                        )
                    )
                )
            ));

            OnToMap::postEvent($eventList);
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
