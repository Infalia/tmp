<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\OnToMap;

class OnToMapController extends Controller
{
    function getUserEvents()
    {
        $params = array('actor' => Auth::id(), 'prettyprint' => 'true');
        $result = OnToMap::getEvents($params);

        $resultArray = json_decode($result, true);
        
        dd($resultArray);
    }

    function getMappings()
    {
        return OnToMap::getMappings();
    }

    function sendMappings()
    {
        $mappings = file_get_contents(storage_path() . '/app/public/files/otm-mapping.json');
        $mappingsArray = json_decode($mappings, true);

        $result = OnToMap::postMapping($mappingsArray);

        return $result;
    }
}
