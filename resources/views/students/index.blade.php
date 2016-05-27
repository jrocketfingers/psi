@extends('layouts.app')

@section('content')
    <div class='container'>
        @foreach($students as $student)
            <div class="row">
                <div class="col-sm-4">
                    {{ $student->name }}
                </div>
                <div class="col-sm-4">
                    <a href="{{ url('/students/show/'.$student->id) }}">Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection