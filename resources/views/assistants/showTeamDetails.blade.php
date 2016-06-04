@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="panel-title text-center">Team</h3>
                        </div>
                        <div class="col-lg-3 pull-right">
                            <a href="{{ action('AssistantsController@getAllTeams') }}">Back</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2">
                                    <span>Name:</span>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    {{ $team->name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2">
                                    <span>Project name:</span>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    {{ $team->project_name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2">
                                    <span>Description:</span>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    {{ $team->description }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2">
                                    <span>Members:</span>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    @foreach($team->students as $student)
                                        <div class="row">
                                            <div class="col-lg-10">
                                                @if($student->is_leader == 1)
                                                    <strong>{{ $student->user->name }}</strong>
                                                @else
                                                    {{ $student->user->name }}
                                                @endif
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