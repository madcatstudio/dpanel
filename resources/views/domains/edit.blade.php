@extends('layouts.app')

@section('content')
    <h1>Edit domain</h1>
    <hr>

    <form method="POST" action="/domains/{{ $domain->id }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <div class="row">
            <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="control-label" for="name">Name *</label>

                <input id="name" type="text" placeholder="example.com"
                       class="form-control"
                       name="name" value="{{ $domain->name }}"
                       aria-describedby="helpBlockName"
                       required autofocus>

                @if ($errors->has('name'))
                    <span id="helpBlockName" class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="col-md-4 form-group{{ $errors->has('registration_date') ? ' has-error' : '' }}">
                <label class="control-label" for="registration_date">Registration date *</label>

                <input id="registration_date" type="date"
                       class="form-control"
                       name="registration_date" value="{{ $domain->registration_date->format('Y-m-d') }}"
                       aria-describedby="helpBlockRegistrationDate"
                       required>

                @if ($errors->has('registration_date'))
                    <span id="helpBlockRegistrationDate"
                          class="help-block">{{ $errors->first('registration_date') }}</span>
                @endif
            </div>

            <div class="col-md-4 form-group{{ $errors->has('ip') ? ' has-error' : '' }}">
                <label class="control-label" for="ip">IP Address *</label>

                <input id="ip" type="text" placeholder="192.168.0.1"
                       class="form-control"
                       name="ip" value="{{ $domain->ip }}"
                       aria-describedby="helpBlockIp"
                       required>

                @if ($errors->has('ip'))
                    <span id="helpBlockIp" class="help-block">{{ $errors->first('ip') }}</span>
                @endif
            </div>
        </div>

        <div class="btn-group-lg">
            <button class="btn btn-success"type="submit" >Update</button>
            <a class="btn btn-link" href="{{ URL::previous() }}">Cancel</a>
        </div>

    </form>
@endsection