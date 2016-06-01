@extends('layouts.app')

@section('details')
	<li><a href="{{ action('StudentsController@show', [Auth::user()->id]) }}" ><i class="fa fa-btn fa-info"></i>Details</a></li>

	@if ($student->is_leader)
		<li><a href="{{ url('students/team/delete') }}" ><i class="fa fa-btn fa-info"></i>Disband Team</a></li>
	@else
		<li><a href="{{ url('students/team/create') }}" ><i class="fa fa-btn fa-info"></i>Create Team</a></li>
	@endif
	
@endsection

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
			                    </div>
		                        
		                        @foreach ($team->students as $student)
		                        	<div class="col-lg-1 col-lg-offset-1">
		                        		<label class="label label-default">
			                        		{{ $student->user->name }}
			                        	</label>
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