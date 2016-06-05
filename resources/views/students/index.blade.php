@extends('layouts.students')

@section('content')
    <div class='container'>
	   @foreach ($teams as $team)
	        <div class="row">
	            <div class="col-lg-8 col-lg-offset-2">
	                <div class="panel panel-default">
	                    <div class="panel-heading">
		                    <div class="row">
		                    	<div class="col-lg-4">
									<a href="{{ action('StudentsController@showTeam', [$team->id]) }}">{{ $team->name }}</a>
									@if (!($student->team))
			                    	<a class="label label-success" href="{{ action('JoinsController@create', [$team->id]) }}"> Join </a>
									@endif
			                    </div>

			                    <div class="col-lg-8 text-center">
			                    	@foreach ($team->students as $team_student)
		                        		<a style="margin-right:0.5em; margin-left:0.5em" class="label label-default" href="{{ action('StudentsController@show', [$team_student->user->id]) }}">
			                        		{{ $team_student->user->name }}
			                        	</a>
			                        @endforeach
			                    </div>      
		                    </div>
		                    
	                    </div>
	                    <div class="panel-body">
	                        <label>{{ $team->project_name }}</label>
	                        <p> {{ $team->description }} </p>

	                        @foreach ($team->roles as $role)
	                        	<div class="col-lg-1 col-lg-offset-1">
	                        		<label class="label label-default">
		                        		{{ $role->name }}
		                        	</label>
	                        	</div>
	                        @endforeach
	                    </div>
	                </div>
	            </div>
	        </div>
	    @endforeach
    </div>
@endsection