<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Subdomain;
use Illuminate\Http\Request;

class SubdomainsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Domain $domain)
    {
        return view('subdomains.create', compact('domain'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'domain_id' => 'required',
        ]);

        Subdomain::create([
            'domain_id' => $request->domain_id,
            'name' => $request->name,
        ]);

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$request->domain_id);
    }

    public function edit(Subdomain $subdomain)
    {
        return view('subdomains.edit', compact('subdomain'));
    }

    public function update(Subdomain $subdomain, Request $request)
    {
        $subdomain->update($request->all());

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$request->domain_id);
    }

    public function destroy(Subdomain $subdomain)
    {
        $domain = $subdomain->domain;
        $subdomain->delete();

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$domain->id);
    }
}
