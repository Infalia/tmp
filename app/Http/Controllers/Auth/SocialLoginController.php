<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\SocialNetwork;
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
        return Socialite::driver('facebook')->fields([
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
            'location',
            'timezone',
            'education',
            'political',
            'religion',
            'work',
            'events'
        ])->scopes([
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
                'location',
                'timezone',
                'education',
                'political',
                'religion',
                'work',
                'events'
            ])->user();
            // $socUser->token;
        } catch (Exception $e) {
            return redirect('login/facebook');
        }

        //$request->session()->put('user.social_data.facebook', $socUser);


        if(!empty($socUser)) {
            $socUserData = json_encode($socUser);
            
            $user = User::find(Auth::id());
            $socialNetwork = SocialNetwork::where("title", "ILIKE", "%Facebook%")->first();

            if(!empty($user) && !empty($socialNetwork)) {
                $user->socialNetworks()->attach($socialNetwork->id, ['data' => $socUserData, 'created_at' => date('Y-m-d H:i:s')]);
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
        return Socialite::driver('google')->redirect();
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
            // $socUser->token;
        } catch (Exception $e) {
            return redirect('login/google');
        }

        //$request->session()->put('user.social_data.google', $socUser);

        if(!empty($socUser)) {
            $socUserData = json_encode($socUser);
            
            $user = User::find(Auth::id());
            $socialNetwork = SocialNetwork::where("title", "ILIKE", "%Google%")->first();

            if(!empty($user) && !empty($socialNetwork)) {
                $user->socialNetworks()->attach($socialNetwork->id, ['data' => $socUserData, 'created_at' => date('Y-m-d H:i:s')]);
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
        } catch (Exception $e) {
            return redirect('login/linkedin');
        }

        //$request->session()->put('user.social_data.linkedin', $socUser);

        if(!empty($socUser)) {
            $socUserData = json_encode($socUser);
            
            $user = User::find(Auth::id());
            $socialNetwork = SocialNetwork::where("title", "ILIKE", "%LinkedIn%")->first();

            if(!empty($user) && !empty($socialNetwork)) {
                $user->socialNetworks()->attach($socialNetwork->id, ['data' => $socUserData, 'created_at' => date('Y-m-d H:i:s')]);
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
            // $socUser->token;
        } catch (Exception $e) {
            return redirect('login/twitter');
        }

        //$request->session()->put('user.social_data.twitter', $socUser);

        if(!empty($socUser)) {
            $socUserData = json_encode($socUser);
            
            $user = User::find(Auth::id());
            $socialNetwork = SocialNetwork::where("title", "ILIKE", "%Twitter%")->first();

            if(!empty($user) && !empty($socialNetwork)) {
                $user->socialNetworks()->attach($socialNetwork->id, ['data' => $socUserData, 'created_at' => date('Y-m-d H:i:s')]);
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
        }

        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }
}
