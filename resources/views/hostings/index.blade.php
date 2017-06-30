@extends('layouts.app')

@section('content')
    <h1>Hostings</h1>
    <hr>
    <div class="row">
        <div class="panel panel-default">

            <ul class="list-group">
                @foreach( $hostings as $letter => $hostingCollection)
                    <li class="list-group-item letter">
                        <h4>{{ $letter }}</h4>
                    </li>

                    @foreach($hostingCollection as $hosting)
                        <li class="list-group-item">
                            <a href="{{ url('/hostings/'.$hosting->id) }}">{{ $hosting->name }}</a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
@endsection