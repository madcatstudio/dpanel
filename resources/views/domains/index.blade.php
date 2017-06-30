@extends('layouts.app')

@section('content')
    <h1>Domains</h1>
    <hr>
    <div class="row">
        <div class="container">
            <div class="panel panel-default">

                <ul class="list-group">
                    @forelse( $domains as $letter => $domainCollection)
                        <li class="list-group-item letter">
                            <h4>{{ $letter }}</h4>
                        </li>

                        @foreach($domainCollection as $domain)
                            <li class="list-group-item">
                                <a href="{{ url('/domains/'.$domain->id) }}">{{ $domain->name }}</a>
                            </li>
                        @endforeach
                    @empty
                        <li class="list-group-item">
                            No domains in database
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection