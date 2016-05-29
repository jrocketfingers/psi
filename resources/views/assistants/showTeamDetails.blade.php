@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">{{ $team->name }}</div>
        <div class="row">{{ $team->project_name }}</div>
        <div class="row">{{ $team->description }}</div>
        @foreach($team->students as $student)
            <div class="row">{{ $student->user->name }}</div>
        @endforeach
    </div>
    <div>
        <a href="{{ url('assistants/showAllTeams') }}">Back</a>
    </div>
@endsection