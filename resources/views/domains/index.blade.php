@extends('layouts.app')

@section('content')
    <h1>Domains</h1>
    <hr>
    <div class="row">
        <ul class="has-columns">
            @foreach( $domains as $letter => $domainCollection)
                <div class="letter-group">
                    <h3 class="letter">{{ $letter }}</h3>

                    <ul>
                        @foreach($domainCollection as $domain)
                            <li>
                                <a href="{{ url('/domains/'.$domain->id) }}">{{ $domain->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </ul>
    </div>
@endsection