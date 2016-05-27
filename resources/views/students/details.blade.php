@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>Name:</div>
            <div>{{ $user->name }}</div>
            <div>Email:</div>
            <div>{{ $user->email}}</div>
            @if($team != null)
                <div>{{ $team->name }}</div>
            @endif
        </div>
    </div>
    <div>
        <a href="{{ url('/students') }}">Back</a>
    </div>
@endsection