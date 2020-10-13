<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function redirect()
    {
        $position = Location::get(Request::ip());
        $countryCode = $position ? $position->countryCode : 'AA';
        $country = Country::where('alpha_code2', $countryCode)->first();
        $default = Country::where('name', 'Default')->first()->redirects()->first();
        $redirect = $country->redirects()->first();

        if ($redirect) {
            return Redirect::to($redirect->url);
        } elseif ($default) {
            return Redirect::to($default->url);
        }

        return Redirect::to('https://idealtrends.com.br');
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }
}
