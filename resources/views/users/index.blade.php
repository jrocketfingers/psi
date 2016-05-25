@extends('layouts.app')

@section('content')
    <thead>
        <th>Users</th>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <div>{{ $user->name }}</div>
            </tr>
        @endforeach
    </tbody>
@endsection