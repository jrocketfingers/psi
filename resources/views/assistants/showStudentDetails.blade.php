@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="panel-title text-center">Student</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2">
                                    <span>Name:</span>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    {{ $student->user->name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2">
                                    <span>Email:</span>
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    {{ $student->user->email}}
                                </div>
                            </div>
                            @if($student->team != null)
                                <div class="row">
                                    <div class="col-lg-4 col-lg-offset-2">
                                        <span>Team name:</span>
                                    </div>
                                    <div class="col-lg-4 col-lg-offset-2">
                                        <a href="{{ action('AssistantsController@showTeamDetails', [$student->team->id]) }}">
                                            {{ $student->team->name }}
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="row" style="text-align: center;">
                                @foreach($student->roles as $role)
                                    <div class="col-lg-4 text-center">
                                        <a class="label label-default" href="{{ action('AssistantsController@showRole', [$role->id]) }}">
                                            {{ $role->name }}
                                        </a>
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
@endsection