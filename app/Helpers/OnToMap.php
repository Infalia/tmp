<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;


class OnToMap
{
    function getOnToMapEvents() {
        $client = new Client();

        try {
            // $result = $client->request('GET', 'https://api.ontomap.eu/api/v1/logger/events?actor=123456');

            // $result = $client->post('https://api.ontomap.eu/api/v1/logger/events', [
            $result = $client->request('POST', env('OTM_EVENTS_URL'), [
                'json' => [
                    'event_list' => [
                        'actor' => 106,
                        'timestamp' => 1485338648883,
                        'activity_type' => 'object_created',
                        'activity_objects' => [
                            'type' => 'Feature',
                            'geometry' => [
                                'type' => 'Point',
                                'coordinates' => ['7.7007722854614', '45.07340695622']
                            ],
                            'properties' => [
                                'hasType' => 'School',
                                'external_url' => 'http://api.dev.firstlife.di.unito.it/v5/fl/Things/58d0ef732ecf55042b380AAA',
                                'hasName' => 'Another School Name',
                                'additionalProperties' => [
                                    'zoom_level' => 13,
                                    'description' => 'Another School Description'
                                ]
                            ]
                        ],
                        'application' => env('OTM_APP_ID')
                    ]
                ],
                'cert' => env('CERT_PATH')
            ]);

            return (string) $result->getBody();
        } catch (RequestException $e) {
            //echo Psr7\str($e->getRequest());
            //echo Psr7\str($e->getResponse());
        } catch (ClientException $e) {
            die('Client exception');
        }
    }
}