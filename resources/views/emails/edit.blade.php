@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <div class="container">
            <div class="hero-body">
                <h1 class="title">{{ $email->fullName }}</h1>
                <p class="subtitle">edit email</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-4 is-offset-4">

                    <form method="POST" action="/emails/{{ $email->id }}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <input type="hidden" name="domain_id" id="domain_id" value="{{ $email->domain->id }}">

                        <div class="field">
                            <label for="name" class="label">Email name</label>

                            <p class="control has-icons-right">
                                <input id="name" type="text" placeholder="example"
                                       class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                       name="name" value="{{ $email->name }}" required autofocus>
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
                            <label for="password" class="label">Email password</label>

                            <p class="control has-icons-right">
                                <input id="password" type="text" placeholder="enter password"
                                       class="input{{ $errors->has('password') ? ' is-danger' : '' }}"
                                       name="password" value="{{ $email->password }}" required>
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