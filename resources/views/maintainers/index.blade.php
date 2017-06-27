@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <div class="container">
            <div class="hero-body">
                <h1 class="title">Maintainers</h1>
                <p class="subtitle">All your maintainers.</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <ul class="has-columns has-text-centered">
                @foreach( $maintainers as $letter => $maintainerCollection)
                    <div class="letter-group">
                        <h3 class="title is-1 letter">{{ $letter }}</h3>

                        <ul>
                            @foreach($maintainerCollection as $maintainer)
                                <li class="title is-5">
                                    <a href="{{ url('/maintainers/'.$maintainer->id) }}">{{ $maintainer->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </ul>
        </div>
    </section>
@endsection