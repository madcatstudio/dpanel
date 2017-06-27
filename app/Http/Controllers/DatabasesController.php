<?php

namespace App\Http\Controllers;

use App\Database;
use App\Domain;
use Illuminate\Http\Request;

class DatabasesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Domain $domain)
    {
        return view('databases.create', compact('domain'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'domain_id' => 'required',
        ]);

        Database::create([
            'domain_id' => $request->domain_id,
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$request->domain_id);
    }

    public function edit(Database $database)
    {
        return view('databases.edit', compact('database'));
    }

    public function update(Database $database, Request $request)
    {
        $database->update($request->all());

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$request->domain_id);
    }

    public function destroy(Database $database)
    {
        $domain = $database->domain;
        $database->delete();

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }

        return redirect('/domains/'.$domain->id);
    }
}
