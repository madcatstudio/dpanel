@extends('layouts.app')

@section('content')
    <h1>New hosting</h1>
    <hr>
    <form method="POST" action="/hostings">
        {{ csrf_field() }}

        @include('hostings.components.form')

        <div class="btn-group-lg">
            <button class="btn btn-success"type="submit" >Create</button>
            <a class="btn btn-link" href="{{ URL::previous() }}">Cancel</a>
        </div>
    </form>
@endsection