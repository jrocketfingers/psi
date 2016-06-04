@extends('layouts.students')

@section('content')
    <div class='container'>
	   @foreach ($teams as $team)
	        <div class="row">
	            <div class="col-lg-8 col-lg-offset-2">
	                <div class="panel panel-default">
	                    <div class="panel-heading">
		                    <div class="row">
		                    	<div class="col-lg-2">
			                    	{{ $team->name }}
			                    	<a class="label label-success" href="{{ action('JoinsController@create', [$team->id]) }}"> Join </a>
			                    </div>
		                        
		                        @foreach ($team->students as $student)
		                        	<div class="col-lg-1 col-lg-offset-1">
		                        		<a class="label label-default" href="{{ action('StudentsController@show', [$student->user->id]) }}">
			                        		{{ $student->user->name }}
			                        	</a>
		                        	</div>
		                        @endforeach
		                    </div>
		                    
	                    </div>
	                    <div class="panel-body">
	                        <p>This is a Random Description</p>

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