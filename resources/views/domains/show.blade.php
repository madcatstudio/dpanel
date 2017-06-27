@extends('layouts.app')

@section('content')
    <h1 class="text-center">{{ $domain->name }}</h1>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <p>Register date: {{ $domain->formattedRegistrationDate }}</p>
            <p>IP: {{ $domain->ip }}</p>

            <a class="btn btn-primary" href="/domains/{{ $domain->id }}/edit">Edit domain</a>

            <a class="btn btn-danger" href="/domains/{{ $domain->id }}"
               onclick="event.preventDefault(); del('delete-domain')">Delete domain</a>
            <form id="delete-domain"
                  method="POST"
                  action="/domains/{{ $domain->id }}"
                  style="display: none;">
                {{ csrf_field() }}
                {{ method_field('delete') }}
            </form>

            <hr>

            {{--HOSTING--}}
            @if($domain->hasHosting)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hosting</h3>
                    </div>
                    <div class="panel-body">
                        <a href="/hostings/{{ $domain->hosting->id }}"
                           class="btn btn-default btn-sm">{{ $domain->hosting->name }}</a>
                        <p>
                            <strong>Url</strong> <code>{{ $domain->hosting->website }}</code> <a
                                    href="{{ $domain->hosting->website }}" target="_blank" class="btn btn-default btn-xs"><span
                                        class="glyphicon glyphicon-link"></span> open link</a><br>
                            <strong>Username</strong> <code>{{ $domain->hosting->username }}</code><br>
                            <strong>Password</strong> <code>{{ $domain->hosting->password }}</code>
                        </p>
                        <hr>
                        <form id="remove-hosting" method="POST" action="/domains/{{ $domain->id }}">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <input id="hosting_id" name="hosting_id" type="hidden" value="">
                            <button type="submit" class="btn btn-warning btn-block">Remove</button>
                        </form>
                    </div>
                </div>
            @else
                <form id="add-hosting" method="POST" action="/domains/{{ $domain->id }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="form-group">
                        <label for="hosting_id">Hosting</label>

                        <select id="hosting_id" name="hosting_id" class="form-control">
                            <option value="">Select hosting</option>
                            @foreach($hostings as $hosting)
                                <option value="{{ $hosting->id }}">{{ $hosting->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Select</button>
                </form>
            @endif

            <hr>

            {{--MAINTAINER--}}
            @if($domain->hasMaintainer)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Maintainer</h3>
                    </div>
                    <div class="panel-body">
                        <strong>{{ $domain->maintainer->name }}
                            <a href="/maintainers/{{ $domain->maintainer->id }}"><span
                                        class="glyphicon glyphicon-share-alt"></span></a>
                        </strong>
                        <p><a href="{{ $domain->maintainer->website }}"
                              target="_blank">{{ $domain->maintainer->website }}</a></p>

                        <strong>Username</strong> <code>{{ $domain->maintainer->username }}</code><br>
                        <strong>Password</strong> <code>{{ $domain->maintainer->password }}</code>

                        <hr>

                        <form method="POST" action="/domains/{{ $domain->id }}">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <input id="maintainer_id" name="maintainer_id" type="hidden" value="">
                            <button type="submit" class="btn btn-warning btn-block">Remove</button>
                        </form>

                    </div>
                </div>
            @else
                <form method="POST" action="/domains/{{ $domain->id }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="form-group">
                        <label for="maintainer_id">Maintainer</label>

                        <select id="maintainer_id" name="maintainer_id" class="form-control">
                            <option value="">Select maintainer</option>
                            @foreach($maintainers as $maintainer)
                                <option value="{{ $maintainer->id }}">{{ $maintainer->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Select</button>
                </form>
            @endif
            <hr>
        </div>

        <div class="col-md-8">

            {{--SUBDOMAIN--}}
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left" style="padding-top: 7.5px;">Subdomains</h3>
                    <div class="btn-group-sm pull-right">
                        <a class="btn btn-success" href="/domains/{{ $domain->id }}/subdomains/create"><span
                                    class="glyphicon glyphicon-plus"></span> Add
                            Subdomain</a>
                    </div>
                </div>

            @if($domain->subdomains->count() > 0)
                <!-- List group -->
                    <ul class="list-group">
                        @foreach($domain->subdomains as $subdomain)
                            <li class="list-group-item clearfix">
                                <div class="pull-left">
                                    {{ $subdomain->fullUrl }} <a
                                            href="{{ $subdomain->fullUrl }}" target="_blank" class="btn btn-default btn-xs"><span
                                                class="glyphicon glyphicon-link"></span> open link</a>
                                </div>
                                <div class="pull-right">
                                    <form id="delete-subdomain-{{ $subdomain->id }}" method="POST"
                                          action="/subdomains/{{ $subdomain->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <div class="btn-group-xs">
                                            <a class="btn btn-default"
                                               href="/subdomains/{{ $subdomain->id }}/edit">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                            </a>
                                            <a class="btn btn-danger" href="/subdomains/{{ $subdomain->id }}"
                                               onclick="event.preventDefault(); del('delete-subdomain-{{ $subdomain->id }}')">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <hr>

            {{--DATABASE--}}
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left" style="padding-top: 7.5px;">Databases</h3>
                    <div class="btn-group-sm pull-right">
                        <a class="btn btn-success" href="/domains/{{ $domain->id }}/databases/create"><span
                                    class="glyphicon glyphicon-plus"></span> Add
                            Database</a>
                    </div>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($domain->databases as $database)
                        <tr>
                            <td><code>{{ $database->name }}</code></td>
                            <td><code>{{ $database->username }}</code></td>
                            <td><code>{{ $database->password }}</code></td>
                            <td>
                                <form id="delete-database-{{ $database->id }}" method="POST"
                                      action="/databases/{{ $database->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <div class="btn-group-sm">
                                        <a class="btn btn-primary" href="/databases/{{ $database->id }}/edit">Edit</a>
                                        <a class="btn btn-danger" href="/databases/{{ $database->id }}"
                                           onclick="event.preventDefault();
                                                   del('delete-database-{{ $database->id }}')">
                                            Delete
                                        </a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            {{-- EMAIL --}}
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left" style="padding-top: 7.5px;">Emails</h3>
                    <div class="btn-group-sm pull-right">
                        <a class="btn btn-success" href="/domains/{{ $domain->id }}/emails/create"><span
                                    class="glyphicon glyphicon-plus"></span> Add
                            Email</a>
                    </div>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($domain->emails as $email)
                        <tr>
                            <td><code>{{ $email->fullName }}</code></td>
                            <td><code>{{ $email->password }}</code></td>
                            <td>
                                <form id="delete-email-{{ $email->id }}" method="POST"
                                      action="/emails/{{ $email->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <div class="btn-group-sm">
                                        <a class="btn btn-primary" href="/emails/{{ $email->id }}/edit">Edit</a>
                                        <a class="btn btn-danger" href="/emails/{{ $email->id }}"
                                           onclick="event.preventDefault();
                                                   del('delete-email-{{ $email->id }}')">
                                            Delete
                                        </a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{--WEBAPP--}}
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left" style="padding-top: 7.5px;">Webapps</h3>
                    <div class="btn-group-sm pull-right">
                        <a class="btn btn-success" href="/domains/{{ $domain->id }}/webapps/create"><span
                                    class="glyphicon glyphicon-plus"></span> Add
                            Webapp</a>
                    </div>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($domain->webapps as $webapp)
                        <tr>
                            <td><code>{{ $webapp->name }}</code></td>
                            <td><code>{{ $webapp->username }}</code></td>
                            <td><code>{{ $webapp->password }}</code></td>
                            <td><code>{!! nl2br($webapp->details) !!}</code></td>
                            <td>

                                <form id="delete-webapp-{{ $webapp->id }}" method="POST"
                                      action="/webapps/{{ $webapp->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <div class="btn-group-sm">
                                        <a class="btn btn-primary" href="/webapps/{{ $webapp->id }}/edit">Edit</a>
                                        <a class="btn btn-danger" href="/webapps/{{ $webapp->id }}"
                                           onclick="event.preventDefault();
                                                   del('delete-webapp-{{ $webapp->id }}')">
                                            Delete
                                        </a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection