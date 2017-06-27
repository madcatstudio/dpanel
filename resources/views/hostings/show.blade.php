@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <div class="container">
            <div class="hero-body">
                <h1 class="title">{{ $hosting->name }}</h1>
            </div>

            <div class="hero-foot">
                <nav class="tabs">
                    <div class="container">
                        <ul>
                            <li><a href="/hostings/{{ $hosting->id }}/edit">Edit</a></li>
                            <li>
                                <a href="/hostings/{{ $hosting->id }}"
                                   onclick="event.preventDefault();
                                   del('delete-hosting')">
                                    Delete
                                </a>
                                <form id="delete-hosting"
                                      method="POST"
                                      action="/hostings/{{ $hosting->id }}"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="box">
                        <div class="level">
                            <div class="level-left">
                                <div class="level-item">
                                    <h1 class="title">Account information</h1>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    {{--<a class="button is-primary" href="/hostings/create">Add Hosting</a>--}}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="content">
                            <dl>
                                <dt>WEBSITE</dt>
                                <dd><a href="{{ $hosting->website }}" target="_blank">{{ $hosting->website }}</a></dd>
                                <dt>USERNAME</dt>
                                <dd>{{ $hosting->username }}</dd>
                                <dt>PASSWORD</dt>
                                <dd>{{ $hosting->password }}</dd>
                                <dt>DETAILS</dt>
                                <dd>{!! nl2br($hosting->details) !!}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

