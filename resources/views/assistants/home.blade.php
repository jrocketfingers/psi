@extends('home')

@section('user_content')
    <a href="{{ url('assistants/getAllStudents') }}">See all students</a><br>
    <a href="{{ url('assistants/getAllTeams') }}">See all teams</a>
@endsection