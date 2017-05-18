<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Overriders\UwumOAuth2Provider;

class UwumLoginController extends Controller
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

    use AuthenticatesUsers;

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
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Redirect the user to the UWUM authentication page.
     *
     * @return Response
     */
    public function redirectToUwumProvider()
    {
        $provider = new UwumOAuth2Provider([
            'clientId' => env('UWUM_CLIENT_ID'), // The client ID assigned to you by UWUM Certificate Authority (actually your CN)
            'clientSecret' => '', // We need no clientSecret since we are using certificates for client authentication
            'redirectUri' => env('UWUM_CALLBACK_URL'), // Currently should be the same as declared in UWUM Certificate Authority
            'urlAuthorize' => env('UWUM_AUTH_URL'), // UWUM API endpoints
            'urlAccessToken' => env('UWUM_TOKEN_URL'),
            'cert' => env('CERT_PATH'), // Path to your pem (outside web directory)
            'urlResourceOwnerDetails' => '' // N/A
        ]);


        // If we don't have an authorization code yet then get one
        if (!isset($_GET['code'])) {
            // Fetch the authorization URL from the provider; this returns the urlAuthorize option and generates and applies
            // any necessary parameters. (e.g. state). At this point you set scopes (multiple scopes are space separated).
            $options = [
                'scope' => ['read_contents read_authors']
            ];

            $authorizationUrl = $provider->getAuthorizationUrl($options);

            // Get the state generated for you and store it to the session.
            $_SESSION['oauth2state'] = $provider->getState();

            // Redirect the user to the authorization URL.
            header('Location: ' . $authorizationUrl);

            exit;
            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);

            exit('Invalid state');
        } else {
            try {
                // Try to get an access token using the authorization code grant.
                $accessToken = $provider->getAccessToken('authorization_code', [
                        'code' => $_GET['code']
                    ]
                );

                echo '<h1>--- RAW DATA received from UWUM ---</h1>';
                echo 'token='.$accessToken->getToken() . "\n<br />";
                echo 'refresh token='.$accessToken->getRefreshToken() . "\n<br />";
                echo 'expires='.$accessToken->getExpires() . "\n<br />";
                echo ($accessToken->hasExpired() ? 'expired' : 'not expired') . "\n<br />";
                echo 'values='; print_r($accessToken->getValues()) . "\n<br />";

                // We have an access token, which we may use in authenticated
                // requests against the service provider's API.
                $request = $provider->getAuthenticatedRequest('POST', 'https://wegovnow.liquidfeedback.com/api/1/validate',$accessToken);
                
                $httpResponse = $provider->getResponse($request);
                
                echo '<h1>--- VALIDATE access token ---</h1>';
                echo 'response: '; print_r($httpResponse) . "\n<br />";
                // Call any UWUM API (e.g. info)
                $request = $provider->getAuthenticatedRequest('GET', 'https://wegovnow.liquidfeedback.com/api/1/info', $accessToken);
                $httpResponse = $provider->getResponse($request);
                
                echo '<h1>--- CALLING GET/info ---</h1>';
                echo 'response: '; print_r($httpResponse) . "\n<br />";
            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                // Failed to get the access token or user details.
                print_r($e->getResponseBody());
                print('<a href="grant.php">Refresh</a>');
                exit();
            }
        }
    }

    /**
     * Obtain the user information from UWUM.
     *
     * @return Response
     */
    public function handleUwumCallback(Request $request)
    {
        // if(!isset($_REQUEST['state'], $_REQUEST['code'])) {
        //     die('Callback failed (state and code do not received correctly)<br />');
        // }

        //$request->session()->put('user.social_data.google', $socUser);

        $input = $request->all();

        echo '<pre>';
        print_r($input);
        echo '</pre>';

        return redirect('profile/social-data');
    }
}
