@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>Name:</div>
            <div>{{ $student->user->name }}</div>
            <div>Email:</div>
            <div>{{ $student->user->email}}</div>
            @if($student->team != null)
                <div>{{ $student->team->name }}</div>
            @endif
        </div>
    </div>
    <div>
        <a href="{{ url('/students') }}">Back</a>
    </div>
@endsection