@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <div class="container">
            <div class="hero-body">
                <h1 class="title">{{ $domain->name }}</h1>
                <p class="subtitle">edit domain</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-4 is-offset-4">

                    <form method="POST" action="/domains/{{ $domain->id }}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="field">
                            <label for="name" class="label">Name</label>

                            <p class="control has-icons-right">
                                <input id="name" type="text" placeholder="example.com"
                                       class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                       name="name" value="{{ $domain->name }}" required autofocus>
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
                                       name="registration_date" value="{{ $domain->registration_date }}" required>
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
                                       name="ip" value="{{ $domain->ip }}" required>
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

                        <div class="field is-grouped">
                            <p class="control">
                                <button type="submit" class="button is-primary">Update</button>
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