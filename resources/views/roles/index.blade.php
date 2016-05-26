@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ action('RolesController@create') }}">Add new role</a>
    </div>
    <div>
        <table>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td><a href="{{ action('RolesController@show', [$role->id]) }}">Show details</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection