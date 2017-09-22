<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class FacebookApi
{
    /**
     * Get Facebook API user fields.
     *
     * @return array, the request response.
     */
    public static function getUserFields($url = '', $networkUserId = '', $fields = array(), $accessToken = '')
    {
        $client = new Client();
 
        try {
           $result = $client->request('GET', $url.$networkUserId.'?fields='.implode(',', $fields).'&access_token='.$accessToken);
            
           return json_decode($result->getBody());
        } catch (RequestException $e) {
            echo Psr7\str($e->getResponse());
        } catch (ClientException $e) {
            echo Psr7\str($e->getResponse());
        }
    }

    /**
     * Get Facebook API user edges.
     *
     * @return array, the request response.
     */
    public static function getUserData($url = '', $networkUserId = '', $egde = '', $accessToken = '', $params = array())
    {
        $client = new Client();

        $paramsQuery = '';

        if(!empty($params)) {
            $paramsQuery = http_build_query($params);
            $paramsQuery = '&'.$paramsQuery;
        }

        try {
            $result = $client->request('GET', $url.$networkUserId.'/'.$egde.'?access_token='.$accessToken.$paramsQuery);
            $response = json_decode($result->getBody());

            $counter = 0;
            $returnArray = array();
            
            if(isset($response->data) && $response->data != null) {
                foreach($response->data as $data) {
                    $returnArray[$counter] = $data;
                    $counter++;
                }
            

                while(isset($response->paging) && $response->paging != null && isset($response->paging->next) && $response->paging->next != null) {
                    $result = $client->request('GET', $response->paging->next);
                    $response = json_decode($result->getBody());

                    if(isset($response->data) && $response->data != null) {
                        foreach($response->data as $data) {
                            $returnArray[$counter] = $data;
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