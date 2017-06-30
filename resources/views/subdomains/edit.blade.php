@extends('layouts.app')

@section('content')
    <h1>Edit subdomain</h1>
    <h3>{{ $subdomain->fullUrl }}</h3>
    <hr>

    <form method="POST" action="/subdomains/{{ $subdomain->id }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <input type="hidden" name="domain_id" id="domain_id" value="{{ $subdomain->domain->id }}">

        <div class="row">
            <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="control-label" for="name">Name *</label>

                <input id="name" type="text" placeholder="subdomain name"
                       class="form-control"
                       name="name" value="{{ $subdomain->name }}"
                       aria-describedby="helpBlockName"
                       required autofocus>

                @if ($errors->has('name'))
                    <span id="helpBlockName" class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>

        <div class="btn-group-lg">
            <button class="btn btn-success" type="submit">Update</button>
            <a class="btn btn-link" href="{{ URL::previous() }}">Cancel</a>
        </div>
    </form>

@endsection