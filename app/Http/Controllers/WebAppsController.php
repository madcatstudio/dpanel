<?php

namespace App\Http\Controllers;

use App\Domain;
use App\WebApp;
use Illuminate\Http\Request;

class WebAppsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Domain $domain)
    {
        return view('webapps.create', compact('domain'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'domain_id' => 'required',
        ]);

        WebApp::create($request->all());

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$request->domain_id);
    }

    public function edit(WebApp $webapp)
    {
        return view('webapps.edit', compact('webapp'));
    }

    public function update(WebApp $webapp, Request $request)
    {
        $webapp->update($request->all());

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$request->domain_id);
    }

    public function destroy(WebApp $webapp)
    {
        $domain = $webapp->domain;
        $webapp->delete();

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$domain->id);
    }
}
