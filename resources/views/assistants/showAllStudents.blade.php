@extends('layouts.app')

@section('content')
<div class='container'>
    @foreach($students as $student)
    <div class="row">
        <div class="col-sm-4">
            {{ $student->user->name }}
        </div>
        <div class="col-sm-4">
            <a href="{{ url('/assistants/showStudentDetails/'.$student->user_id) }}">Details</a>
        </div>
    </div>
    @endforeach
    <div>
        <a href="{{ url('/home') }}">Back</a>
    </div>
</div>
@endsection