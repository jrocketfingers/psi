@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($teams as $team)
            <div class="row">
                <div class="col-sm-4">
                    {{ $team->name }}
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('/assistants/showTeamDetails/'.$team->id) }}">Details</a>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        <a href="{{ url('/home') }}">Back</a>
    </div>
@endsection