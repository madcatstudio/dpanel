@extends('layouts.app')

@section('content')
    <h1>Edit database</h1>
    <h3>{{ $database->domain->name }}</h3>
    <hr>

    <form method="POST" action="/databases/{{ $database->id }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <input type="hidden" name="domain_id" id="domain_id" value="{{ $database->domain->id }}">

        <div class="row">
            <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="control-label" for="name">Name *</label>

                <input id="name" type="text" placeholder="name"
                       class="form-control"
                       name="name" value="{{ $database->name }}"
                       aria-describedby="helpBlockName"
                       required autofocus>

                @if ($errors->has('name'))
                    <span id="helpBlockName" class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="col-md-4 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label class="control-label" for="username">Username *</label>

                <input id="username" type="text" placeholder="username"
                       class="form-control"
                       name="username" value="{{ $database->username }}"
                       aria-describedby="helpBlockUsername"
                       required>

                @if ($errors->has('username'))
                    <span id="helpBlockUsername" class="help-block">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <div class="col-md-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label" for="password">Password *</label>

                <input id="password" type="text" placeholder="Password"
                       class="form-control"
                       name="password" value="{{ $database->password }}"
                       aria-describedby="helpBlockPassword"
                       required>

                @if ($errors->has('password'))
                    <span id="helpBlockPassword" class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>

        <div class="btn-group-lg">
            <button class="btn btn-success" type="submit">Update</button>
            <a class="btn btn-link" href="{{ URL::previous() }}">Cancel</a>
        </div>
    </form>
@endsection