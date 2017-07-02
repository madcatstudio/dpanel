@extends('layouts.app')

@section('content')
    <h1>{{ $domain->name }}</h1>
    <hr>
    <div class="row">
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Domain information</h3>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        Register date <code>{{ $domain->formattedRegistrationDate }}</code>
                    </li>
                    <li class="list-group-item">
                        IP <code>{{ $domain->ip }}</code>
                    </li>
                </ul>
                <div class="panel-footer clearfix">
                    <div class="pull-right">
                        <div class="btn-group-sm">
                            <a class="btn btn-default btn-circle" href="/domains/{{ $domain->id }}/edit"
                               title="Edit domain"><span class="glyphicon glyphicon-pencil"></span></a>

                            <a class="btn btn-danger btn-circle" href="/domains/{{ $domain->id }}"
                               onclick="event.preventDefault(); del('delete-domain')" title="Delete domain"><span
                                        class="glyphicon glyphicon-remove"></span></a>
                            <form id="delete-domain"
                                  method="POST"
                                  action="/domains/{{ $domain->id }}"
                                  style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            {{--HOSTING--}}
            @if($domain->hasHosting)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hosting</h3>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <code>{{ $domain->hosting->name }}</code>
                        </li>
                        <li class="list-group-item">
                            <strong>Url</strong> <code>{{ $domain->hosting->website }}</code>
                        </li>
                        <li class="list-group-item">
                            <strong>Username</strong> <code>{{ $domain->hosting->username }}</code>
                        </li>
                        <li class="list-group-item">
                            <strong>Password</strong> <code>{{ $domain->hosting->password }}</code>
                        </li>
                    </ul>

                    <div class="panel-footer clearfix">
                        <div class="pull-right">
                            <form id="remove-hosting" method="POST" action="/domains/{{ $domain->id }}">
                                {{ csrf_field() }}
                                {{ method_field('patch') }}
                                <input id="hosting_id" name="hosting_id" type="hidden" value="">
                            </form>
                            <div class="btn-group-sm">
                                <div class="btn-group dropup">
                                    <button type="button" class="btn btn-sm btn-default btn-circle dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                                class="glyphicon glyphicon-link"></span> Open link <span
                                                class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="/hostings/{{ $domain->hosting->id }}">Hosting details</a></li>
                                        <li><a href="{{ $domain->hosting->website }}" target="_blank">Hosting provider
                                                website</a></li>
                                    </ul>
                                </div>
                                <button type="submit" form="remove-hosting" class="btn btn-default btn-circle"
                                        title="Remove hosting"><span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </div>
                        </div>
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

                    <ul class="list-group">
                        <li class="list-group-item">
                            <code>{{ $domain->maintainer->name }}</code>
                        </li>
                        <li class="list-group-item">
                            <strong>Url</strong> <code>{{ $domain->maintainer->website }}</code>
                        </li>
                        <li class="list-group-item">
                            <strong>Username</strong> <code>{{ $domain->maintainer->username }}</code>
                        </li>
                        <li class="list-group-item">
                            <strong>Password</strong> <code>{{ $domain->maintainer->password }}</code>
                        </li>
                    </ul>

                    <div class="panel-footer clearfix">
                        <div class="pull-right">
                            <form id="remove-maintainer" method="POST" action="/domains/{{ $domain->id }}">
                                {{ csrf_field() }}
                                {{ method_field('patch') }}
                                <input id="maintainer_id" name="maintainer_id" type="hidden" value="">
                            </form>
                            <div class="btn-group-sm">
                                <div class="btn-group dropup">
                                    <button type="button" class="btn btn-sm btn-default btn-circle dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                                class="glyphicon glyphicon-link"></span> Open link <span
                                                class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="/maintainers/{{ $domain->maintainer->id }}">Maintainer details</a>
                                        </li>
                                        <li><a href="{{ $domain->maintainer->website }}" target="_blank">Maintainer
                                                provider
                                                website</a></li>
                                    </ul>
                                </div>
                                <button type="submit" form="remove-maintainer" class="btn btn-default btn-circle"
                                        title="Remove maintainer"><span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </div>
                        </div>
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
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Url</th>
                                <th>Edit</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($domain->subdomains as $subdomain)
                                <tr>
                                    <td>
                                        <code>{{ $subdomain->fullUrl }}</code> <a
                                                href="{{ $subdomain->fullUrl }}" target="_blank"
                                                class="btn btn-default btn-xs btn-circle"><span
                                                    class="glyphicon glyphicon-link"></span> open link</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-circle btn-xs"
                                           href="/subdomains/{{ $subdomain->id }}/edit">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <form id="delete-subdomain-{{ $subdomain->id }}" method="POST"
                                              action="/subdomains/{{ $subdomain->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}

                                            <a class="btn btn-danger btn-circle btn-xs"
                                               href="/subdomains/{{ $subdomain->id }}"
                                               onclick="event.preventDefault(); del('delete-subdomain-{{ $subdomain->id }}')">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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

                @if($domain->databases->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Edit</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($domain->databases as $database)
                                <tr>
                                    <td><code>{{ $database->name }}</code></td>
                                    <td><code>{{ $database->username }}</code></td>
                                    <td><code>{{ $database->password }}</code></td>
                                    <td>
                                        <a class="btn btn-primary btn-circle btn-xs"
                                           href="/databases/{{ $database->id }}/edit">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <form id="delete-database-{{ $database->id }}" method="POST"
                                              action="/databases/{{ $database->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}

                                            <a class="btn btn-danger btn-circle btn-xs"
                                               href="/databases/{{ $database->id }}"
                                               onclick="event.preventDefault(); del('delete-database-{{ $database->id }}')">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
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

                @if($domain->emails->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Edit</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($domain->emails as $email)
                                <tr>
                                    <td><code>{{ $email->fullName }}</code></td>
                                    <td><code>{{ $email->password }}</code></td>
                                    <td>
                                        <a class="btn btn-primary btn-circle btn-xs"
                                           href="/emails/{{ $email->id }}/edit">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <form id="delete-email-{{ $email->id }}" method="POST"
                                              action="/emails/{{ $email->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}

                                            <a class="btn btn-danger btn-circle btn-xs" href="/emails/{{ $email->id }}"
                                               onclick="event.preventDefault(); del('delete-email-{{ $email->id }}')">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <hr>

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

                @if($domain->webapps->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                {{--<th>Details</th>--}}
                                <th>Edit</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($domain->webapps as $webapp)
                                <tr>
                                    <td><code>{{ $webapp->name }}</code></td>
                                    <td><code>{{ $webapp->username }}</code></td>
                                    <td><code>{{ $webapp->password }}</code></td>
                                    {{--<td><code>{!! nl2br($webapp->details) !!}</code></td>--}}
                                    <td>
                                        <a class="btn btn-primary btn-circle btn-xs"
                                           href="/webapps/{{ $webapp->id }}/edit">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <form id="delete-webapp-{{ $webapp->id }}" method="POST"
                                              action="/webapps/{{ $webapp->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}

                                            <a class="btn btn-danger btn-circle btn-xs"
                                               href="/webapps/{{ $webapp->id }}"
                                               onclick="event.preventDefault(); del('delete-webapp-{{ $webapp->id }}')">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </a>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection