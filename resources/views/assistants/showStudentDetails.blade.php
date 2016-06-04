@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="panel-title text-center">Student</h3>
                        </div>
                        <div class="col-lg-3 pull-right">
                            <a href="{{ action('AssistantsController@getAllStudents') }}">Back</a>
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
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-2">
                                    <span>Roles:</span>
                                </div>
                                <div class="col-lg-6 col-lg-offset-4">
                                    @foreach($student->roles as $role)
                                        <div class="row">
                                            <div class="col-lg-6">
                                                {{ $role->name }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if($student->team != null)
                                <div class="row">
                                    <div class="col-lg-4 col-lg-offset-2">
                                        <span>Team name:</span>
                                    </div>
                                    <div class="col-lg-4 col-lg-offset-2">
                                        {{ $student->team->name }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection