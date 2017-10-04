<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

use App\User;
use App\SocialNetwork;
use App\Helpers\FacebookApi;
use App\Helpers\TwitterApi;
use App\Helpers\GoogleApi;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            
            $users = User::all();
            $facebookNetwork = SocialNetwork::where("title", "ILIKE", "%Facebook%")->first();
            $twitterNetwork = SocialNetwork::where("title", "ILIKE", "%Twitter%")->first();
            $googleNetwork = SocialNetwork::where("title", "ILIKE", "%Google%")->first();
            
    
            if(!empty($users)) {
                foreach($users as $user) {



                    /*******************
                     * Facebook network *
                     *******************/
                    $userNetwork = $user->socialNetworks()->where('social_network_id', $facebookNetwork->id)->get();
                    $userNetworkData = $user->socialNetworkData()->where('social_network_id', $facebookNetwork->id)->get();
            
                    if($userNetwork->isNotEmpty()) {
                        $networkApiUrl = env('FACEBOOK_API_URL');
                        $accessToken = $userNetwork->first()->pivot->token;
                        $tokenExpires = $userNetwork->first()->pivot->token_expire;
                        $networkUserId = $userNetwork->first()->pivot->network_user_id;
            
            
                        $dataSince = ''; 
            
                        if($userNetworkData->isNotEmpty()) {
                            $dataSince = $userNetworkData->first()->pivot->since;
                            //$dataSince = '1483271643';
                            $dataSinceDt = Carbon::createFromTimestamp($dataSince);
                        }
                        
            
            
                        $now = Carbon::now();
                        $tokenExpiresDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $tokenExpires);
            
                        if($now->lt($tokenExpiresDateTime)) {
                            $requestFields = [
                                'id',
                                'name',
                                'email',
                                'gender',
                                'verified',
                                'link',
                                'first_name',
                                'middle_name',
                                'last_name',
                                'picture',
                                'about',
                                'age_range',
                                'birthday',
                                'hometown',
                                'locale',
                                'location',
                                'timezone',
                                'education',
                                'languages',
                                'political',
                                'religion',
                                'favorite_athletes',
                                'favorite_teams',
                                'inspirational_people',
                                'sports'
                            ];
            
            
                            $params = array();
            
                            if(!empty($dataSince)) {
                                $params = array('since' => $dataSince);
                            }

                            
            
                            $info = FacebookApi::getUserInfo($networkApiUrl, $networkUserId, $requestFields, $accessToken);
                            $likes = FacebookApi::getUserData($networkApiUrl, $networkUserId, 'likes', $accessToken); // likes cannot be filtered by since/until
                            $posts = FacebookApi::getUserData($networkApiUrl, $networkUserId, 'posts', $accessToken, $params);
                            $events = FacebookApi::getUserData($networkApiUrl, $networkUserId, 'events', $accessToken, $params);
            
                            
                            $count = 0;
                            $latestLikes = $likes; // For the first time we want all page likes
            
                            // If it's not the first time we request page likes,
                            // we filter them by created_time
                            if(!empty($dataSinceDt)) {
                                $latestLikes = array();
                            }
                            
                            foreach($likes as $like) {
                                $likeDt = Carbon::createFromFormat('Y-m-d\TH:i:sO', $like->created_time);
                                
                                if(!empty($dataSinceDt) && $likeDt->gt($dataSinceDt)) {
                                    $latestLikes[$count] = array('name' => $like->name, 'id' => $like->id, 'created_time' => $like->created_time);
                                    $count++;
                                }
                            }
                
            
                            
                            $userInfo = '';
                            $userData = '';
                            
                            if(!empty($info)) {
                                $userInfo = collect($info)->toJson();
                            }
            
                            if(!empty($latestLikes)) {
                                $userData .= collect($latestLikes)->toJson();
                            }
                            if(!empty($posts)) {
                                $userData .= collect($posts)->toJson();
                            }
                            if(!empty($events)) {
                                $userData .= collect($events)->toJson();
                            }
            
            
            
                            $userFacebookInfo = ['profile_info' => $userInfo];
                            $userFacebookData = ['data' => $userData, 'since' => $now->timestamp];
            
                            
                            if(!empty($userInfo)) {
                                $user->socialNetworks()->updateExistingPivot($facebookNetwork->id, $userFacebookInfo);
                            }
                            if(!empty($userData)) {
                                $user->socialNetworkData()->save($facebookNetwork, $userFacebookData);
                            }
            
                            //file_put_contents(storage_path() . '/app/public/files/schedule-facebook.txt', Carbon::now().' - Updated');
                        }
                    }






                    /*******************
                     * Twitter network *
                     *******************/
                    $userNetwork = $user->socialNetworks()->where('social_network_id', $twitterNetwork->id)->get();
                    $userNetworkData = $user->socialNetworkData()->where('social_network_id', $twitterNetwork->id)->get();
            
                    if($userNetwork->isNotEmpty()) {
                        $networkApiUrl = env('TWITTER_API_URL');
                        $accessToken = $userNetwork->first()->pivot->token;
                        $networkUserId = $userNetwork->first()->pivot->network_user_id;
            
            
                        $dataSince = ''; 
            
                        if($userNetworkData->isNotEmpty()) {
                            $dataSince = $userNetworkData->first()->pivot->since;
                            //$dataSince = '735057326957268993';
                        }
                        
            
                        $params = array(
                            'user_id' => $networkUserId,
                            'count' => 200
                        );
            
                        if(!empty($dataSince)) {
                            $params['since_id'] = $dataSince;
                        }
            
                        
                        $info = TwitterApi::getUserInfo($networkApiUrl.'/users/show.json', $accessToken, $params);
                        $tweets = TwitterApi::getUserData($networkApiUrl.'/statuses/user_timeline.json', $accessToken, $params);    
            
                        
                        $userInfo = '';
                        $userData = '';
                        $firstTweetId = 0;
                        
                        if(!empty($info)) {
                            $userInfo = collect($info)->toJson();
                        }
            
                        if(!empty($tweets)) {
                            $userData .= collect($tweets)->toJson();
                            $firstTweet = array_first($tweets);
                            $firstTweetId = $firstTweet->id;
                        }
            
            
                        $userTwitterInfo = ['profile_info' => $userInfo];
                        $userTwitterData = ['data' => $userData, 'since' => $firstTweetId];
            
                        
                        if(!empty($userInfo)) {
                            $user->socialNetworks()->updateExistingPivot($twitterNetwork->id, $userTwitterInfo);
                        }
                        if(!empty($userData)) {
                            $user->socialNetworkData()->save($twitterNetwork, $userTwitterData);
                        }
            
                        //file_put_contents(storage_path() . '/app/public/files/schedule-twitter.txt', Carbon::now().' - Updated');
                    }






                    /*******************
                     * Google network *
                     *******************/
                    $userNetwork = $user->socialNetworks()->where('social_network_id', $googleNetwork->id)->get();
                    $userNetworkData = $user->socialNetworkData()->where('social_network_id', $googleNetwork->id)->get();
             
                    if($userNetwork->isNotEmpty()) {
                        $networkApiUrl = env('GOOGLE_API_URL');
                        $apiKey = env('GOOGLE_API_KEY');
                        $networkUserId = $userNetwork->first()->pivot->network_user_id;
                        $userNetwork = $user->socialNetworks()->where('social_network_id', $googleNetwork->id)->get();
                        $userNetworkData = $user->socialNetworkData()->where('social_network_id', $googleNetwork->id)->get();
        
                        $params = array(
                            'maxResults' => 100
                        );
                        
                        $userInfo = '';
                        $userData = '';

                        $info = GoogleApi::getUserInfo($networkApiUrl.'people/'.$networkUserId, $apiKey);
                        $activities = GoogleApi::getUserData($networkApiUrl.'people/'.$networkUserId.'/activities/public', $apiKey, $params);
                        
                        if(!empty($info)) {
                            $userInfo = collect($info)->toJson();
                        }
                        if(!empty($activities)) {
                            $userData .= collect($activities)->toJson();
                        }
        
                        
                        $userGoogleInfo = ['profile_info' => $userInfo];
                        $userGoogleData = ['data' => $userData];

                        if(!empty($userInfo)) {
                            $user->socialNetworks()->updateExistingPivot($googleNetwork->id, $userGoogleInfo);
                        }
                        if(!empty($userData)) {
                            if($userNetworkData->isNotEmpty()) {
                                $user->socialNetworkData()->detach($googleNetwork->id);
                            }

                            $user->socialNetworkData()->save($googleNetwork, $userGoogleData);
                        }
                    }

                    file_put_contents(storage_path() . '/app/public/files/schedule-google.txt', Carbon::now().' - Updated');
                }
            }
        })->dailyAt('04:00');
        //})->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
