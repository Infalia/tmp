<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;

class SocialLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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

        $request->session()->put('user.social_data.facebook', $socUser);
        
        //$authUser = $this->findOrCreateUser($socUser);
        //Auth::login($authUser, true);

        return redirect('profile/social-data');
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

        $request->session()->put('user.social_data.google', $socUser);

        return redirect('profile/social-data');
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

        $request->session()->put('user.social_data.linkedin', $socUser);

        return redirect('profile/social-data');
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

        $request->session()->put('user.social_data.twitter', $socUser);

        return redirect('profile/social-data');
    }

    /**
     * Redirect the user to the Pinterest authentication page.
     *
     * @return Response
     */
    public function redirectToPinterestProvider()
    {
        return Socialite::with('pinterest')->scopes([
            'read_public',
            'write_public',
            'read_relationships',
            'write_relationships'
        ])->redirect();
    }

    /**
     * Obtain the user information from Pinterest.
     *
     * @return Response
     */
    public function handlePinterestProviderCallback(Request $request)
    {
        try {
            $socUser = Socialite::driver('pinterest')->user();
            // $token = $socUser->accessTokenResponseBody;
        } catch (Exception $e) {
            return redirect('login/pinterest');
        }

        $request->session()->put('user.social_data.pinterest', $socUser);

        return redirect('profile/social-data');
    }
}
