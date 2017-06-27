@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <div class="container">
            <div class="hero-body">
                <h1 class="title">New domain</h1>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-4 is-offset-4">

                    <form method="POST" action="{{ url('/domains') }}">
                        {{ csrf_field() }}

                        <div class="field">
                            <label for="name" class="label">Name</label>

                            <p class="control has-icons-right">
                                <input id="name" type="text" placeholder="example.com"
                                       class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                       name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                @endif
                            </p>
                            @if ($errors->has('name'))
                                <p class="help is-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="registration_date" class="label">Registration date</label>

                            <p class="control has-icons-right">
                                <input id="registration_date" type="date"
                                       class="input{{ $errors->has('registration_date') ? ' is-danger' : '' }}"
                                       name="registration_date" value="{{ old('registration_date') }}" required>
                                @if ($errors->has('registration_date'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                @endif
                            </p>
                            @if ($errors->has('registration_date'))
                                <p class="help is-danger">{{ $errors->first('registration_date') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="ip" class="label">IP Address</label>

                            <p class="control has-icons-right">
                                <input id="ip" type="text" placeholder="192.168.0.1"
                                       class="input{{ $errors->has('ip') ? ' is-danger' : '' }}"
                                       name="ip" value="{{ old('ip') }}" required>
                                @if ($errors->has('ip'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                @endif
                            </p>
                            @if ($errors->has('ip'))
                                <p class="help is-danger">{{ $errors->first('ip') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="hosting_id" class="label">Hosting</label>

                            <p class="control has-icons-right">
                                <span class="select">
                                    <select id="hosting_id" name="hosting_id">
                                        <option value="">Select hosting</option>
                                        @foreach($hostings as $hosting)
                                            <option value="{{ $hosting->id }}">{{ $hosting->name }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </p>
                        </div>

                        <div class="field">
                            <label for="maintainer_id" class="label">Maintainer</label>

                            <p class="control has-icons-right">
                                <span class="select">
                                    <select id="maintainer_id" name="maintainer_id">
                                        <option value="">Select maintainer</option>
                                        @foreach($maintainers as $maintainer)
                                            <option value="{{ $maintainer->id }}">{{ $maintainer->name }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </p>
                        </div>

                        <div class="field is-grouped">
                            <p class="control">
                                <button type="submit" class="button is-primary">Create</button>
                            </p>
                            <p class="control">
                                <a class="button is-link" href="{{ URL::previous() }}">Cancel</a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection