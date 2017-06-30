@extends('layouts.app')

@section('content')
    <h1>New email</h1>
    <h3>{{ $domain->name }}</h3>
    <hr>

    <form method="POST" action="/emails">
        {{ csrf_field() }}

        <input type="hidden" name="domain_id" id="domain_id" value="{{ $domain->id }}">

        <div class="row">
            <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="control-label" for="name">Email Name *</label>

                <div class="input-group">
                    <input id="name" type="text" placeholder="emailname"
                           class="form-control"
                           name="name" value="{{ old('name') }}"
                           aria-describedby="helpBlockName"
                           required autofocus>
                    <span class="input-group-addon" id="helpBlockName">{{ '@'.$domain->name }}</span>
                </div>

                @if ($errors->has('name'))
                    <span id="helpBlockName" class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="col-md-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label" for="password">Password *</label>

                <input id="password" type="text" placeholder="Password"
                       class="form-control"
                       name="password" value="{{ old('password') }}"
                       aria-describedby="helpBlockPassword"
                       required>

                @if ($errors->has('password'))
                    <span id="helpBlockPassword" class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>

        <div class="btn-group-lg">
            <button class="btn btn-success" type="submit">Create</button>
            <a class="btn btn-link" href="{{ URL::previous() }}">Cancel</a>
        </div>
    </form>
@endsection