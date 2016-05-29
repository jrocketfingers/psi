@extends('layouts.app')

@section('content')
    <div>{{ $user->name }}</div>
    <div>{{ $user->email }}</div>
    <div><a href="{{ action('UsersController@edit', [$user->id]) }}">Edit</a> </div>
    {{--@if(\App\Student::isStudent($user->id))
        <div>
            <a href="{{ url('/students_roles/'.$user->id)}}">My roles</a>
        </div>
    @endif--}}
@endsection