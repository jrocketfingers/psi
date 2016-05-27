@extends('layouts.app')

@section('content')
    <div class='container'>
        @foreach($students as $student)
            <div class="row">
                <div class="col-sm-4">
                    {{ $student->name }}
                </div>
            </div>
        @endforeach
    </div>
@endsection