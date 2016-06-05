@extends('layouts.assistants')

@section('content')
<div class='container'>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="panel-title text-center">
                                Teams
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        @foreach($teams as $team)
                            <div class="row">
                                <div class="col-md-6">
                                    {{ $team->name }}
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ action('AssistantsController@showTeamDetails', [$team->id]) }}">Details</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection