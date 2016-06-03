@extends('layouts.app')

@section('details')
	<li><a href="{{ action('StudentsController@show', [Auth::user()->id]) }}" ><i class="fa fa-btn fa-info"></i>Details</a></li>

	@if ($student->is_leader)
		<li><a href="{{ url('students/team/delete') }}" ><i class="fa fa-btn fa-info"></i>Disband Team</a></li>
	@else
		@if ($student->team)
			<li><a href="{{ url('students/team/leave', [$student->team->id]) }}" ><i class="fa fa-btn fa-info"></i>Leave Team</a></li>
		@else
			<li><a href="{{ url('students/team/create') }}" ><i class="fa fa-btn fa-info"></i>Create Team</a></li>
		@endif
	@endif
	
@endsection

@section('content')
    <div class='container'>
	   @foreach ($students as $student)
	   <div class="row">
	   		<div class="col-md-8 col-md-offset-2">
	   			<div class="panel panel-default">
	                    <div class="panel-heading">
		                    <span> {{ $student->name }} </span>
		                    <span class="label label-success text-right">
		                    	Invite
		                    </span>
		                </div>
		                <div class="panel-body">
		                	@foreach ($student->roles as $role)
		                		<div class="label label-default">
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