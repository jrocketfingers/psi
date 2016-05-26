@extends('layouts.app')

@section('content')
    <form class="form-group" role="form" method="POST" action="{{ url('/students_roles/create') }}">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="sel">Chose role:</label>
            <select class="form-group" id="sel" name="sel">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Add role">
        </div>
    </form>
@endsection