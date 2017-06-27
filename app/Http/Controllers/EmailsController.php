<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Email;
use Illuminate\Http\Request;

class EmailsController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }

    public function create(Domain $domain)
    {
        return view('emails.create', compact('domain'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'domain_id' => 'required'
        ]);

        Email::create([
            'domain_id' => $request->domain_id,
            'name' => $request->name,
            'password' => $request->password,
        ]);

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }
        return redirect('/domains/'.$request->domain_id);
    }

    public function edit(Email $email)
    {
        return view('emails.edit', compact('email'));
    }

    public function update(Email $email, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'domain_id' => 'required',
        ]);

        $email->update($request->all());

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }
        return redirect('/domains/'.$email->domain->id);
    }

    public function destroy(Email $email)
    {
        $domain = $email->domain;

        $email->delete();

        if(request()->wantsJson()) {
            return response()->json([], 201);
        }
        return redirect('/domains/'.$domain->id);
    }
}
