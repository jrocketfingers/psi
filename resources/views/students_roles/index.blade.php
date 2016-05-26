@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ url('/students_roles/create') }}">Add role</a>
    </div>
    <div class="container">
        @foreach($roles as $role)
            <div class="row">
                <div class="col-sm-4">{{ $role->name }}</div>
            </div>
        @endforeach
    </div>
@endsection