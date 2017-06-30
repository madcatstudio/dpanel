@extends('layouts.app')

@section('content')
    <h1>Edit webapp</h1>
    <h3>{{ $webapp->domain->name }}</h3>
    <hr>

    <form method="POST" action="/webapps/{{ $webapp->id }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <input type="hidden" name="domain_id" id="domain_id" value="{{ $webapp->domain->id }}">

        <div class="row">
            <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="control-label" for="name">Name *</label>

                <input id="name" type="text" placeholder="Wordpress"
                       class="form-control"
                       name="name" value="{{ $webapp->name }}"
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
                       name="username" value="{{ $webapp->username }}"
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
                       name="password" value="{{ $webapp->password }}"
                       aria-describedby="helpBlockPassword"
                       required>

                @if ($errors->has('password'))
                    <span id="helpBlockPassword" class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                <label class="control-label" for="details">Details</label>

                <textarea id="details" name="details"
                          class="form-control" aria-describedby="helpBlockDetails"
                          placeholder="Enter some details...">{{ $webapp->details }}</textarea>

                @if ($errors->has('details'))
                    <span id="helpBlockDetails" class="help-block">{{ $errors->first('details') }}</span>
                @endif
            </div>
        </div>

        <div class="btn-group-lg">
            <button class="btn btn-success" type="submit">Update</button>
            <a class="btn btn-link" href="{{ URL::previous() }}">Cancel</a>
        </div>
    </form>
@endsection