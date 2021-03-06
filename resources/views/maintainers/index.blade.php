@extends('layouts.app')

@section('content')
    <h1>Maintainers</h1>
    <hr>
    <div class="row">
        <div class="container">
            <div class="panel panel-default">

                <ul class="list-group">
                    @forelse( $maintainers as $letter => $maintainerCollection)
                        <li class="list-group-item letter">
                            <h4>{{ $letter }}</h4>
                        </li>

                        @foreach($maintainerCollection as $maintainer)
                            <li class="list-group-item">
                                <a href="{{ url('/maintainers/'.$maintainer->id) }}">{{ $maintainer->name }}</a>
                            </li>
                        @endforeach
                    @empty
                        <li class="list-group-item">
                            No maintainers in database
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection