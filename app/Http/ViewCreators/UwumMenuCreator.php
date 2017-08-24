<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;

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
                    $uwumAccessToken = $request->session()->get('uwumAccessToken')->getRefreshToken();
                }

                $paramsQuery .= '&access_token='.$uwumAccessToken;
            }


            try {
                $result = $client->request('GET', env('UWUM_NAV_URL').$paramsQuery);
                $this->navigationMenu = (string) $result->getBody();
                //$request->session()->put('uwumNavMenu', $this->navigationMenu);
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