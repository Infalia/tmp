<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use App\Overriders\UwumOAuth2Provider;

class UwumMenuCreator
{
    /**
     * The UWUM navigation menu.
     */
    protected $navigationMenu = '';

    /**
     * Create the UWUM navigation menu.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        // if($request->session()->exists('uwumNavMenu')) {
        //     $this->navigationMenu = $request->session()->get('uwumNavMenu');
        // }
        // else {
            $client = new Client();
            $paramsQuery = '?client_id='.env('UWUM_CLIENT_ID').'&login_url='.url('login/uwum');

            if(Auth::check() && $request->session()->exists('uwumAccessToken')) {
                if(!$request->session()->get('uwumAccessToken')->hasExpired()) {
                    $uwumAccessToken = $request->session()->get('uwumAccessToken')->getToken();
                }
                else {
                    $provider = new UwumOAuth2Provider([
                        'clientId' => env('UWUM_CLIENT_ID'), // The client ID assigned to you by UWUM Certificate Authority (actually your CN)
                        'clientSecret' => '', // We need no clientSecret since we are using certificates for client authentication
                        'redirectUri' => env('UWUM_CALLBACK_URL'), // Currently should be the same as declared in UWUM Certificate Authority
                        'urlAuthorize' => env('UWUM_AUTH_URL'), // UWUM API endpoints
                        'urlAccessToken' => env('UWUM_TOKEN_URL'),
                        'cert' => env('CERT_PATH'), // Path to your pem (outside web directory)
                        'urlResourceOwnerDetails' => '' // N/A
                    ]);


                    $newAccessToken = $provider->getAccessToken('refresh_token', [
                        'refresh_token' => $request->session()->get('uwumAccessToken')->getRefreshToken()
                    ]);
                
                    $request->session()->forget('uwumAccessToken');
                    $request->session()->put('uwumAccessToken', $newAccessToken);
                    $uwumAccessToken = $request->session()->get('uwumAccessToken')->getToken();
                }


                $paramsQuery .= '&access_token='.$uwumAccessToken;
            }


            try {
                $result = $client->request('GET', env('UWUM_NAV_URL').$paramsQuery);

                $this->navigationMenu = (string) $result->getBody();
            } catch (RequestException $e) {
                $this->getFallbackNavigationMenu();
            } catch (ClientException $e) {
                $this->getFallbackNavigationMenu();
            }
        //}
    }

    /**
     * Create the fallback UWUM navigation bar.
     *
     * @return void
     */
    public function getFallbackNavigationMenu()
    {
        $this->navigationMenu = '{"result":[{"active":true,"description":"map & plan","name":"FirstLife","url":"http://wegovnow.firstlife.di.unito.it/"},{"description":"report local issues","name":"Improve My City","url":"https://wegovnow.infalia.com/"},{"description":"debate & decide","name":"LiquidFeedback","url":"https://wegovnow.liquidfeedback.com/"},{"description":"collect & share","name":"Community Maps","url":"http://wegovnow-cm.geokey.org.uk/"},{"description":"or register","name":"Login","url":"https://wegovnow.liquidfeedback.com/index/login.html"}]}';
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function create(View $view)
    {
        $view->with('uwumNavigation', json_decode($this->navigationMenu, true));
    }
}