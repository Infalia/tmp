<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use Socialite;

class SocialLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->scopes([
            'public_profile',
            'user_about_me',
            'email',
            'user_actions.books',
            'user_actions.fitness',
            'user_actions.music',
            'user_actions.news',
            'user_actions.video',
            'user_birthday',
            'user_education_history',
            'user_events',
            'user_games_activity',
            'user_hometown',
            'user_likes',
            'user_location',
            'user_photos',
            'user_posts',
            'user_relationships',
            'user_relationship_details',
            'user_religion_politics',
            'user_tagged_places',
            'user_videos',
            'user_website',
            'user_work_history',
            'read_custom_friendlists'
        ])->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleFacebookProviderCallback(Request $request)
    {
        try {
            $socUser = Socialite::driver('facebook')->fields([
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
            ])->user();
        } catch (\Exception $e) {
            return redirect('profile/social-accounts');
        }


        if(!empty($socUser)) {
            // Get the user & social network id
            $user = User::find(Auth::id());
            $socialNetwork = SocialNetwork::where("title", "ILIKE", "%Facebook%")->first();


            // Based on Facebook docs, we have a short-lived access token,
            // but we need a long-lived one (60 days).
            // So, we make a request for a code from Facebook's server
            $code = '';
            
            if(!$request->session()->exists('social_data.facebook.code')) {
                $client = new Client();

                try {
                    $result = $client->request('GET', 'https://graph.facebook.com/oauth/client_code?access_token='.$socUser->token.'&client_id='.env('FACEBOOK_APP_ID').'&client_secret='.env('FACEBOOK_APP_SECRET').'&redirect_uri='.env('FACEBOOK_APP_CALLBACK_URL'));
                    $response = json_decode($result->getBody());

                    $code = $response->code;
                    $request->session()->put('social_data.facebook.code', $code);
                } catch (RequestException $e) {
                    return redirect('profile/social-accounts');
                } catch (ClientException $e) {
                    return redirect('profile/social-accounts');
                }
            }

            
            // Now that we have the code, we make a request for the long-lived token
            // and store it along with other useful data to the database.
            if(!empty($code)) {
                $client = new Client();

                try {
                    $result = $client->request('GET', 'https://graph.facebook.com/oauth/access_token?code='.$code.'&client_id='.env('FACEBOOK_APP_ID').'&redirect_uri='.env('FACEBOOK_APP_CALLBACK_URL'));
                    $response = json_decode($result->getBody());

                    if(!empty($user) && !empty($socialNetwork)) {
                        $socUserData = json_encode($socUser);
                        $userNetwork = $user->socialNetworks()->where('social_network_id', $socialNetwork->id)->get();
                        $socialNetworkData = ['profile_info' => $socUserData, 'token' => $response->access_token, 'token_expire' => Carbon::now()->addSeconds($response->expires_in)->toDateTimeString(), 'network_user_id' => $socUser->id, 'created_at' => date('Y-m-d H:i:s')];

                        // If user doesn't have a record for the given social network,
                        // create it, otherwise update it
                        if($userNetwork->isEmpty()) {
                            $user->socialNetworks()->attach($socialNetwork->id, $socialNetworkData);
                        }
                        else {
                            $user->socialNetworks()->updateExistingPivot($socialNetwork->id, $socialNetworkData);
                        }




                        if($userNetwork->isEmpty()) {
                            // Get user edges for the first time
                            $params = array();
                            $facebookNetwork = SocialNetwork::where("title", "ILIKE", "%Facebook%")->first();

                            $likes = FacebookApi::getUserData(env('FACEBOOK_API_URL'), $socUser->id, 'likes', $response->access_token); // likes cannot be filtered by since/until
                            $posts = FacebookApi::getUserData(env('FACEBOOK_API_URL'), $socUser->id, 'posts', $response->access_token, $params);
                            $events = FacebookApi::getUserData(env('FACEBOOK_API_URL'), $socUser->id, 'events', $response->access_token, $params);

                            $userData = '';
                            
                            if(!empty($likes)) {
                                $userData .= collect($likes)->toJson();
                            }
                            if(!empty($posts)) {
                                $userData .= collect($posts)->toJson();
                            }
                            if(!empty($events)) {
                                $userData .= collect($events)->toJson();
                            }

                            $userFacebookData = ['data' => $userData, 'since' => Carbon::now()->timestamp];
                            $user->socialNetworkData()->save($facebookNetwork, $userFacebookData);
                        }
                    }
                    
                    $request->session()->forget('social_data.facebook.code');
                } catch (RequestException $e) {
                    return redirect('profile/social-accounts');
                } catch (ClientException $e) {
                    return redirect('profile/social-accounts');
                }
            }
        }


        return redirect('profile/social-accounts');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->scopes([
            'openid',
            'profile',
            'email',
            //'https://www.googleapis.com/auth/plus.login',
            //'https://www.googleapis.com/auth/plus.circles.read',
            //'https://www.googleapis.com/auth/plus.stream.read',
            //'https://www.googleapis.com/auth/userinfo.profile',
            //'https://www.googleapis.com/auth/plus.me',
        ])->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleGoogleProviderCallback(Request $request)
    {
        try {
            $socUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('profile/social-accounts');
        }

        if(!empty($socUser)) {
            // Get the user & social network id
            $user = User::find(Auth::id());
            $socialNetwork = SocialNetwork::where("title", "ILIKE", "%Google%")->first();

            if(!empty($user) && !empty($socialNetwork)) {
                $networkApiUrl = env('GOOGLE_API_URL');
                $apiKey = env('GOOGLE_API_KEY');
                $networkUserId = $socUser->id;
                $userNetwork = $user->socialNetworks()->where('social_network_id', $socialNetwork->id)->get();
                //$userNetworkData = $user->socialNetworkData()->where('social_network_id', $socialNetwork->id)->get();


                // User info
                $userInfo = '';
                $info = GoogleApi::getUserInfo($networkApiUrl.'people/'.$networkUserId, $apiKey);

                if(!empty($info)) {
                    $userInfo = collect($info)->toJson();
                }

                $userGoogleInfo = ['profile_info' => $userInfo, 'network_user_id' => $socUser->id];

                // If user doesn't have a record for the given social network,
                // create it, otherwise update it
                if($userNetwork->isEmpty()) {
                    $user->socialNetworks()->attach($socialNetwork->id, $userGoogleInfo);
                }
                else {
                    $user->socialNetworks()->updateExistingPivot($socialNetwork->id, $userGoogleInfo);
                }




                $params = array(
                    'maxResults' => 100
                );
                
                $userData = '';
                $activities = GoogleApi::getUserData($networkApiUrl.'people/'.$networkUserId.'/activities/public', $apiKey, $params);

                if(!empty($activities)) {
                    $userData .= collect($activities)->toJson();
                }

                $userGoogleData = ['data' => $userData];

                if(!empty($userData)) {
                    $user->socialNetworkData()->save($socialNetwork, $userGoogleData);
                }
            }

        }


        return redirect('profile/social-accounts');
    }

    /**
     * Redirect the user to the LinkedIn authentication page.
     *
     * @return Response
     */
    public function redirectToLinkedinProvider()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Obtain the user information from LinkedIn.
     *
     * @return Response
     */
    public function handleLinkedinProviderCallback(Request $request)
    {
        try {
            $socUser = Socialite::driver('linkedin')->user();
            // $socUser->token;
        } catch (\Exception $e) {
            return redirect('profile/social-accounts');
        }

        //$request->session()->put('user.social_data.linkedin', $socUser);

        if(!empty($socUser)) {
            $socUserData = json_encode($socUser);
            
            $user = User::find(Auth::id());
            $socialNetwork = SocialNetwork::where("title", "ILIKE", "%LinkedIn%")->first();

            if(!empty($user) && !empty($socialNetwork)) {
                $user->socialNetworks()->attach($socialNetwork->id, ['profile_info' => $socUserData, 'created_at' => date('Y-m-d H:i:s')]);
            }
        }


        return redirect('profile/social-accounts');
    }

    /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return Response
     */
    public function redirectToTwitterProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from Twitter.
     *
     * @return Response
     */
    public function handleTwitterProviderCallback(Request $request)
    {
        try {
            $socUser = Socialite::driver('twitter')->user();
        } catch (\Exception $e) {
            return redirect('profile/social-accounts');
        }


        if(!empty($socUser)) {

            // Now we can request for an OAuth2 Bearer Token
            // for our application so we can make API requests.
            $client = new Client();

            try {
                $result = $client->request('POST', 'https://api.twitter.com/oauth2/token?grant_type=client_credentials', [
                    'headers' => ['Authorization' => 'Basic '.base64_encode(env('TWITTER_APP_ID').':'.env('TWITTER_APP_SECRET'))]
                ]);

                $response = json_decode($result->getBody());
            } catch (RequestException $e) {
                return redirect('profile/social-accounts');
            } catch (ClientException $e) {
                return redirect('profile/social-accounts');
            }


            if (!empty($response) && isset($response->token_type) && isset($response->access_token)) {
                // Get the user & social network id
                $user = User::find(Auth::id());
                $socialNetwork = SocialNetwork::where("title", "ILIKE", "%Twitter%")->first();

                if(!empty($user) && !empty($socialNetwork)) {
                    $socUserData = json_encode($socUser);
                    $userNetwork = $user->socialNetworks()->where('social_network_id', $socialNetwork->id)->get();
                    $socialNetworkData = ['profile_info' => $socUserData, 'token' => $response->access_token, 'network_user_id' => $socUser->id, 'created_at' => date('Y-m-d H:i:s')];

                    // If user doesn't have a record for the given social network,
                    // create it, otherwise update it
                    if($userNetwork->isEmpty()) {
                        $user->socialNetworks()->attach($socialNetwork->id, $socialNetworkData);
                    }
                    else {
                        $user->socialNetworks()->updateExistingPivot($socialNetwork->id, $socialNetworkData);
                    }



                    if($userNetwork->isEmpty()) {
                        // Get as many as possible user
                        // tweets for the first time
                        $userData = '';
                        $firstTweetId = 0;

                        $params = array(
                            'user_id' => $socUser->id,
                            'count' => 200
                        );

                        $tweets = TwitterApi::getFirstTimeUserData(env('TWITTER_API_URL').'/statuses/user_timeline.json', $response->access_token, $params);  

                        if(!empty($tweets)) {
                            $userData .= collect($tweets)->toJson();
                            $firstTweet = array_first($tweets);
                            $firstTweetId = $firstTweet->id;
                        }

                        $userTwitterData = ['data' => $userData, 'since' => $firstTweetId];

                        if(!empty($userData)) {
                            $user->socialNetworkData()->save($socialNetwork, $userTwitterData);
                        }
                    }
                }
            }
        }


        return redirect('profile/social-accounts');
    }
    
    function removeAccount(Request $request)
    {
        $socialNetworkId = $request->input('id');
        $socialNetwork = SocialNetwork::find($socialNetworkId);
        
        if(!empty($socialNetwork)) {
            User::find(Auth::id())->socialNetworks()->detach($socialNetworkId);
            User::find(Auth::id())->socialNetworkData()->detach($socialNetworkId);
        }

        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }
}
