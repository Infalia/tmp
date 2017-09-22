<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class TwitterApi
{
    /**
     * Get Twitter API user info.
     *
     * @return array, the request response.
     */
    public static function getUserInfo($url = '', $accessToken = '', $params = array())
    {
        $client = new Client();

        $paramsQuery = '';
        
        if(!empty($params)) {
            $paramsQuery = http_build_query($params);
            $paramsQuery = '?'.$paramsQuery;
        }
 
        try {
            $result = $client->request('GET', $url.$paramsQuery, [
                'headers' => ['Authorization' => 'Bearer '.$accessToken]
            ]);
            
            return json_decode($result->getBody());
        } catch (RequestException $e) {
            echo Psr7\str($e->getResponse());
        } catch (ClientException $e) {
            echo Psr7\str($e->getResponse());
        }
    }

    /**
     * Get Twitter API user collection for the first time.
     *
     * @return array, the request response.
     */
    public static function getFirstTimeUserData($url = '', $accessToken = '', $params = array())
    {
        $client = new Client();

        $paramsQuery = '';

        if(!empty($params)) {
            $paramsQuery = http_build_query($params);
            $paramsQuery = '?'.$paramsQuery;
        }

        try {
            $result = $client->request('GET', $url.$paramsQuery, [
                'headers' => ['Authorization' => 'Bearer '.$accessToken]
            ]);

            $response = json_decode($result->getBody());



            $count = 200;
            $returnArray = array();
            
            if(!empty($response)) {
                foreach($response as $record) {
                    $returnArray[] = $record;
                }
            

                $makeLoop = true;

                while(!empty($response) && $makeLoop) {
                    $lastResponseRecord = array_last($response);
    
                    $result = $client->request('GET', $url.$paramsQuery.'&max_id='.$lastResponseRecord->id, [
                        'headers' => ['Authorization' => 'Bearer '.$accessToken]
                    ]);
                    
                    $response = json_decode($result->getBody());

                    // If response records are fewer than maximum possible records, then stop the loop
                    if($count > count($response)) {
                        $makeLoop = false;
                    }

                    // The loop starts with the second record, because the last one
                    // of the previous loop is the first one of current loop
                    for($i=1; $i<count($response); $i++) {
                        $returnArray[] = $response[$i];
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

    /**
     * Get Twitter API user collection.
     *
     * @return array, the request response.
     */
    public static function getUserData($url = '', $accessToken = '', $params = array())
    {
        $client = new Client();

        $paramsQuery = '';

        if(!empty($params)) {
            $paramsQuery = http_build_query($params);
            $paramsQuery = '?'.$paramsQuery;
        }

        try {
            $result = $client->request('GET', $url.$paramsQuery, [
                'headers' => ['Authorization' => 'Bearer '.$accessToken]
            ]);

            $response = json_decode($result->getBody());
            

            $returnArray = array();
            
            if(!empty($response)) {
                foreach($response as $record) {
                    $returnArray[] = $record;
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