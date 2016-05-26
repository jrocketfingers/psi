@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ action('RolesController@create') }}">Add new role</a>
    </div>
    @foreach($roles as $role)
        <div>{{ $role->name }}</div>
    @endforeach
@endsection