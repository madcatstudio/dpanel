<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Hosting;
use Illuminate\Http\Request;

class HostingsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hostings = Hosting::orderBy('name')->get()->groupBy(function ($hosting) {
            return substr($hosting->name, 0, 1);
        });

        return view('hostings.index', compact('hostings'));
    }

    public function show(Hosting $hosting)
    {
        return view('hostings.show', compact('hosting'));
    }

    public function create()
    {
        return view('hostings.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'website' => 'required|url',
        ]);

        $hosting = Hosting::create($request->all());

        if (request()->wantsJson()) {
            return response()->json([$hosting], 201);
        }

        return redirect('/hostings')->with('message', 'New Hosting created');
    }

    public function edit(Hosting $hosting)
    {
        return view('hostings.edit', compact('hosting'));
    }

    public function update(Hosting $hosting, Request $request)
    {
        $hosting->update($request->all());

        if (request()->wantsJson()) {
            return response()->json([$hosting], 201);
        }

        return redirect('/hostings/'.$hosting->id)->with('message', 'Hosting updated');
    }

    public function destroy(Hosting $hosting)
    {
        $domains = Domain::where('hosting_id', $hosting->id)->get();

        $domains->each(function ($domain) {
            $domain->deleteHosting();
        });

        $hosting->delete();

        if (request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/hostings')->with('message', 'Hosting deleted');
    }
}
