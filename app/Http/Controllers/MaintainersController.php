<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Maintainer;
use Illuminate\Http\Request;

class MaintainersController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $maintainers = Maintainer::orderBy('name')->get()->groupBy(function ($maintainer) {
            return substr($maintainer->name, 0, 1);
        });

        return view('maintainers.index', compact('maintainers'));
    }

    public function show(Maintainer $maintainer)
    {
        return view('maintainers.show', compact('maintainer'));
    }

    public function create()
    {
        return view('maintainers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'website' => 'required|url',
        ]);

        $maintainer = Maintainer::create($request->all());

        if (request()->wantsJson()) {
            return response()->json([$maintainer], 201);
        }

        return redirect('/maintainers')->with('message', 'New Maintainer created');
    }

    public function edit(Maintainer $maintainer)
    {
        return view('maintainers.edit', compact('maintainer'));
    }

    public function update(Maintainer $maintainer, Request $request)
    {
        $maintainer->update($request->all());

        if (request()->wantsJson()) {
            return response()->json([$maintainer], 201);
        }

        return redirect('/maintainers/'.$maintainer->id)->with('message', 'Maintainer updated');
    }

    public function destroy(Maintainer $maintainer)
    {
        $domains = Domain::where('maintainer_id', $maintainer->id)->get();

        $domains->each(function ($domain) {
            $domain->deleteMaintainer();
        });

        $maintainer->delete();

        if (request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/maintainers')->with('message', 'Maintainer deleted');
    }
}
