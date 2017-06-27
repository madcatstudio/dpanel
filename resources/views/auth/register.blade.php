<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.2/css/bulma.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
<section class="hero is-fullheight is-dark is-bold">
    <div class="hero-body">

        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-4 is-offset-4">
                    <h1 class="title">Register</h1>

                    <div class="box">
                        <form role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="field">
                                <label for="name" class="label">Name</label>

                                <p class="control has-icons-left has-icons-right">
                                    <input id="name" type="text"
                                           class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-envelope"></i>
                                    </span>
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
                                <label for="email" class="label">E-Mail Address</label>

                                <p class="control has-icons-left has-icons-right">
                                    <input id="email" type="email"
                                           class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                           name="email" value="{{ old('email') }}" required>
                                    <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    @if ($errors->has('email'))
                                        <span class="icon is-small is-right">
                                                <i class="fa fa-warning"></i>
                                            </span>
                                    @endif
                                </p>
                                @if ($errors->has('email'))
                                    <p class="help is-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div class="field">
                                <label for="password" class="label">Password</label>

                                <p class="control has-icons-left has-icons-right">
                                    <input id="password" type="password"
                                           class="input{{ $errors->has('password') ? ' is-danger' : '' }}"
                                           name="password" required>
                                    <span class="icon is-small is-left">
                                            <i class="fa fa-key"></i>
                                        </span>
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
                                <label for="password-confirm" class="label">Confirm Password</label>

                                <p class="control has-icons-left has-icons-right">
                                    <input id="password-confirm" type="password"
                                           class="input" name="password_confirmation" required>
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </p>
                            </div>

                            <div class="field is-grouped">
                                <p class="control">
                                    <button type="submit" class="button is-primary">Register</button>
                                </p>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <div class="hero-footer">

    </div>
</section>