@extends('layouts.students')

@section('content')
    <div class='container'>
    	<div class="row" style="padding-bottom: 2em;">
    		<div class="col-md-8 col-md-offset-2">
    			{{ Form::open([ 'action' => 'StudentsController@showStudents', 'method' => 'GET']) }}

    			<div class="form-group">
    				<div class="col-md-2">
	    				{{ Form::label('Search', 'Search', ['style' => 'margin-top: 0.25em;', 'class' => 'control-label']) }}
	    			</div>
	    			<div class="col-md-4">
	    				{{ Form::text('search', $search, [ 'class' => 'form-control']) }}
	    			</div>

	    			<div class="col-md-2">
	    				{{ Form::label('Sort', 'Sort Criteria', ['style' => 'margin-top: 0.25em;', 'class' => 'control-label']) }}
	    			</div>

	    			<div class="col-md-4">
	    				{{ Form::select('choice', $choices, null, array('class' => 'form-control')) }}
	    			</div>
    			</div>

    			{{ Form::close() }}
    		</div>
    	</div>
	   @foreach ($students as $show_student)
	   <div class="row">
	   		<div class="col-md-8 col-md-offset-2">
	   			<div class="panel panel-default">
	                    <div class="panel-heading">
							<div class="row">
								<div class="col-lg-6">
									<a class="panel-title text-center" href="{{ action('StudentsController@show', [$show_student->user->id]) }}">{{ $show_student->user->name }}</a>
								</div>
								@if(!($show_student->team) && !($show_student->team == $student->team) && $student->team && $student->is_leader)
								<div class="col-lg-1 pull-right">
									<a href="{{ action('InvitesController@create', [$show_student->user_id]) }}" class="label label-success pull-right">
										Invite
									</a>
								</div>
								@endif
								<div class="col-lg-1 pull-right">
									<a href="{{ url('students/show', [$show_student->user_id]) }}"> Details </a>
								</div>
							</div>
		                </div>
		                <div class="panel-body">
		                	@foreach ($show_student->roles as $role)
		                		<div class="label label-default" style="margin-left:0.5em; margin-right:0.5em;">
									{{ $role->name }}
		                		</div>
		                	@endforeach
		                </div>    
                </div>
	   		</div>
	   </div>
	   @endforeach
    </div>
@endsection