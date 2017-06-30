@extends('layouts.app')

@section('content')
    <h1>{{ $maintainer->name }}</h1>
    <hr>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Account information</h3>
        </div>

        <ul class="list-group">
            <li class="list-group-item">
                WEBSITE <code>{{ $maintainer->website }}</code>
            </li>
            <li class="list-group-item">USERNAME
                <code>{{ $maintainer->username }}</code>
            </li>
            <li class="list-group-item">PASSWORD
                <code>{{ $maintainer->password }}</code>
            </li>
            <li class="list-group-item">DETAILS
                <blockquote>{!! nl2br($maintainer->details) !!}</blockquote>
            </li>
        </ul>
        <div class="panel-footer clearfix">
            <div class="pull-right">
                <div class="btn-group-sm">
                    <a class="btn btn-default btn-circle" href="{{ $maintainer->website }}"
                       target="_blank" title="Maintainer provider website"><span
                                class="glyphicon glyphicon-link"></span></a>
                    <a class="btn btn-default btn-circle" href="/maintainers/{{ $maintainer->id }}/edit"
                       title="Edit maintainer"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a class="btn btn-danger btn-circle" href="/maintainers/{{ $maintainer->id }}"
                       onclick="event.preventDefault(); del('delete-maintainer')" title="Delete maintainer"><span
                                class="glyphicon glyphicon-remove"></span></a>
                    <form id="delete-maintainer"
                          method="POST"
                          action="/maintainers/{{ $maintainer->id }}"
                          style="display: none;">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

