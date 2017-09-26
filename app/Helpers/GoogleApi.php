<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class GoogleApi
{
    /**
     * Get Google API user info.
     *
     * @return array, the request response.
     */
    public static function getUserInfo($url = '', $apiKey = '')
    {
        $client = new Client();
 
        try {
           $result = $client->request('GET', $url.'?key='.$apiKey);
            
           return json_decode($result->getBody());
        } catch (RequestException $e) {
            echo Psr7\str($e->getResponse());
        } catch (ClientException $e) {
            echo Psr7\str($e->getResponse());
        }
    }

    /**
     * Get Google API user collection.
     *
     * @return array, the request response.
     */
    public static function getUserData($url = '', $apiKey = '', $params = array())
    {
        $client = new Client();

        $paramsQuery = '';

        if(!empty($params)) {
            $paramsQuery = http_build_query($params);
            $paramsQuery = '&'.$paramsQuery;
        }

        try {
            $result = $client->request('GET', $url.'?key='.$apiKey.$paramsQuery);
            $response = json_decode($result->getBody());

            $counter = 0;
            $returnArray = array();
            
            if(isset($response->nextPageToken) && !empty($response->nextPageToken)) {
                foreach($response->items as $item) {
                    $returnArray[$counter] = $item;
                    $counter++;
                }
            

                while(isset($response->nextPageToken) && !empty($response->nextPageToken)) {
                    $result = $client->request('GET', $url.'?key='.$apiKey.$paramsQuery.'&pageToken='.$response->nextPageToken);
                    $response = json_decode($result->getBody());

                    if(isset($response->items) && !empty($response->items)) {
                        foreach($response->items as $item) {
                            $returnArray[$counter] = $item;
                            $counter++;
                        }
                    }
                }
            }

            return $returnArray;
        } catch (RequestException $e) {
            echo Psr7\str($e->getResponse());
        } catch (ClientException $e) {
            echo Psr7\str($e->getResponse());
        }
    }
}