@extends('layouts.students')

@section('content')
    <div class='container'>
	   @foreach ($students as $show_student)
	   <div class="row">
	   		<div class="col-md-8 col-md-offset-2">
	   			<div class="panel panel-default">
	                    <div class="panel-heading">
		                    <span> {{ $show_student->name }} </span>
		                    <span class="label label-success text-right">
		                    	Invite
		                    </span>
		                </div>
		                <div class="panel-body">
		                	@foreach ($show_student->roles as $role)
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