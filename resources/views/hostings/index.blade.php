@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <div class="container">
            <div class="hero-body">
                <h1 class="title">Hostings</h1>
                <p class="subtitle">All your hostings.</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <ul class="has-columns has-text-centered">
                @foreach( $hostings as $letter => $hostingCollection)
                    <div class="letter-group">
                        <h3 class="title is-1 letter">{{ $letter }}</h3>

                        <ul>
                            @foreach($hostingCollection as $hosting)
                                <li class="title is-5">
                                    <a href="{{ url('/hostings/'.$hosting->id) }}">{{ $hosting->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </ul>
        </div>
    </section>
@endsection