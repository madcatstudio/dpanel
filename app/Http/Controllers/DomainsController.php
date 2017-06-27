<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Hosting;
use App\Maintainer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DomainsController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $domains = Domain::orderBy('name')->get()->groupBy(function ($domain) {
            return substr($domain->name, 0, 1);
        });

        return view('domains.index', compact('domains'));
    }

    public function show(Domain $domain)
    {
        $domain->with('emails')
            ->with('databases')
            ->with('subdomains')
            ->with('hosting')
            ->with('maintainer')
            ->get();

        $hostings = Hosting::all();
        $maintainers = Maintainer::all();

        return view('domains.show', compact('domain', 'hostings', 'maintainers'));
    }

    public function create()
    {
        $hostings = Hosting::all();
        $maintainers = Maintainer::all();

        return view('domains.create', compact('hostings', 'maintainers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:domains,name',
            'registration_date' => 'date|required',
            'ip' => 'ip|required',
            'hosting_id' => 'sometimes|nullable|exists:hostings,id',
            'maintainer_id' => 'sometimes|nullable|exists:maintainers,id',
        ]);

        Domain::create($request->all());

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains');
    }

    public function edit(Domain $domain)
    {
        return view('domains.edit', compact('domain'));
    }

    public function update(Domain $domain, Request $request)
    {
        $domain->update($request->all());

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$domain->id);
    }

    public function destroy(Domain $domain)
    {
        $domain->emails()->each(function ($email) {
            $email->delete();
        });

        $domain->databases()->each(function ($database) {
            $database->delete();
        });

        $domain->subdomains()->each(function ($subdomains) {
            $subdomains->delete();
        });

        $domain->webapps()->each(function ($webapps) {
            $webapps->delete();
        });

        $domain->delete();

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains');
    }
}
