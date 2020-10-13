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
}
