@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ url('/students_roles/create') }}">Add role</a>
    </div>
    <div class="container">
        @foreach($roles as $role)
            <div class="row">
                <div class="col-sm-4">{{ $role->name }}</div>
                <div class="col-sm-4">
                    <form class="form-group" role="form" method="POST" action="{{ url('/students_roles/destroy/'.$role->id ) }}">
                        {{ csrf_field() }}
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection