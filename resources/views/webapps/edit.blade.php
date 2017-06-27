@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <div class="container">
            <div class="hero-body">
                <h1 class="title">{{ $webapp->domain->name }}</h1>
                <p class="subtitle">edit webapp</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-4 is-offset-4">

                    <form method="POST" action="/webapps/{{ $webapp->id }}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <input type="hidden" name="domain_id" id="domain_id" value="{{ $webapp->domain->id }}">

                        <div class="field">
                            <label for="name" class="label">Name</label>

                            <p class="control has-icons-right">
                                <input id="name" type="text" placeholder="Wordpress"
                                       class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                       name="name" value="{{ $webapp->name }}" required autofocus>
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
                            <label for="username" class="label">Username</label>

                            <p class="control has-icons-right">
                                <input id="username" type="text" placeholder="admin"
                                       class="input{{ $errors->has('username') ? ' is-danger' : '' }}"
                                       name="username" value="{{ $webapp->username }}">
                                @if ($errors->has('username'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                @endif
                            </p>
                            @if ($errors->has('username'))
                                <p class="help is-danger">{{ $errors->first('username') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="password" class="label">Password</label>

                            <p class="control has-icons-right">
                                <input id="password" type="text" placeholder="enter password"
                                       class="input{{ $errors->has('password') ? ' is-danger' : '' }}"
                                       name="password" value="{{ $webapp->password }}">
                                @if ($errors->has('password'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                @endif
                            </p>
                            @if ($errors->has('password'))
                                <p class="help is-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="details" class="label">Details</label>
                            <p class="control">
                                <textarea id="details" name="details"
                                          class="textarea{{ $errors->has('details') ? ' is-danger' : '' }}"
                                          placeholder="Enter some details...">{{ $webapp->details }}</textarea>
                            </p>
                            @if ($errors->has('details'))
                                <p class="help is-danger">{{ $errors->first('details') }}</p>
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