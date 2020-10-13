<?php

namespace App\Http\Controllers;

use App\Country;
use App\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedirectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $redirects = Redirect::all();

        return view('redirects.index', ['redirects' => $redirects]);
    }

    public function create()
    {
        $countries = Country::all();

        return view('redirects.create', ['countries' => $countries]);
    }


    public function edit(Redirect $redirect)
    {
        $countries = Country::all();
        return view('redirects.edit', ['countries' => $countries, 'redirect' => $redirect]);
    }

    public function update(Request $request, Redirect $redirect)
    {
        DB::beginTransaction();
        try {
            $redirect->country_id = $request->input('country');
            $redirect->url = $request->input('url');
            $redirect->save();

            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            return view('redirects.edit', $redirect->id);
        }

        return redirect(route('redirects.index'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $redirect = new Redirect();

            $redirect->country_id = $request->input('country');
            $redirect->url = $request->input('url');
            $redirect->save();

            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            return view('redirects.create');
        }

        return redirect(route('redirects.index'));
    }

    public function destroy(Redirect $redirect)
    {
        $redirect->delete();
        return redirect(route('redirects.index'));
    }
}
