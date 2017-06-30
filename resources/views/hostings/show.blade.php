@extends('layouts.app')

@section('content')
    <h1>{{ $hosting->name }}</h1>
    <hr>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Account information</h3>
        </div>

        <ul class="list-group">
            <li class="list-group-item">
                WEBSITE <code>{{ $hosting->website }}</code>
            </li>
            <li class="list-group-item">USERNAME
                <code>{{ $hosting->username }}</code>
            </li>
            <li class="list-group-item">PASSWORD
                <code>{{ $hosting->password }}</code>
            </li>
            <li class="list-group-item">DETAILS
                <blockquote>{!! nl2br($hosting->details) !!}</blockquote>
            </li>
        </ul>
        <div class="panel-footer clearfix">
            <div class="pull-right">
                <div class="btn-group-sm">
                    <a class="btn btn-default btn-circle" href="{{ $hosting->website }}"
                       target="_blank" title="Hosting provider website"><span
                                class="glyphicon glyphicon-link"></span></a>
                    <a class="btn btn-default btn-circle" href="/hostings/{{ $hosting->id }}/edit"
                       title="Edit hosting"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a class="btn btn-danger btn-circle" href="/hostings/{{ $hosting->id }}"
                       onclick="event.preventDefault(); del('delete-hosting')" title="Delete hosting"><span
                                class="glyphicon glyphicon-remove"></span></a>
                    <form id="delete-hosting"
                          method="POST"
                          action="/hostings/{{ $hosting->id }}"
                          style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

