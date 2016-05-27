@extends('home')

@section('user_content')
    <a href="{{ url('/users') }}">Link for editing users</a><br>
    <a href="{{ action('RolesController@index') }}">Link fore editing roles</a>
@endsection