@extends('layouts.assistants')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="panel-title text-center">Team</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    <label>Name</label>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    {{ $team->name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    <label>Project name</label>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    {{ $team->project_name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    <label>Description</label>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    {{ $team->description }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    <label>Members</label>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    @foreach($team->students as $student)
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <a href="{{ action('AssistantsController@showStudentDetails', [$student->user_id]) }}">
                                                    @if($student->is_leader == 1)
                                                        <strong>{{ $student->user->name }}</strong>
                                                    @else
                                                        {{ $student->user->name }}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection