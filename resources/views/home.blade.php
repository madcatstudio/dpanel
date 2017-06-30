@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Domains</h3>
                </div>

                <div class="panel-body">
                    <h1>{{ \App\Domain::all()->count() }}</h1> domains found in database.
                </div>
                <div class="panel-footer">
                    <a href="{{ url('/domains/create') }}" class="btn btn-success btn-block">Add a domain</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Hostings</h3>
                </div>

                <div class="panel-body">
                    <h1>{{ \App\Hosting::all()->count() }}</h1> hostings found in database.
                </div>
                <div class="panel-footer">
                    <a href="{{ url('/hostings/create') }}" class="btn btn-success btn-block">Add a hosting</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Maintainers</h3>
                </div>

                <div class="panel-body">
                    <h1>{{ \App\Maintainer::all()->count() }}</h1> maintainers found in database.
                </div>
                <div class="panel-footer">
                    <a href="{{ url('/maintainers/create') }}" class="btn btn-success btn-block">Add a maintainer</a>
                </div>
            </div>
        </div>
    </div>
@endsection
