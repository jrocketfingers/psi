@extends('layouts.students')

@section('content')
    <div class='container'>
	   @foreach ($students as $show_student)
	   <div class="row">
	   		<div class="col-md-8 col-md-offset-2">
	   			<div class="panel panel-default">
	                    <div class="panel-heading">
							<div class="row">
								<div class="col-lg-6">
									<h3 class="panel-title text-center">{{ $show_student->user->name }}</h3>
								</div>
								<div class="col-lg-3 pull-right">
									<a href="{{ action('InvitesController@create', [$show_student->user_id]) }}" class="label label-success pull-right">
										Invite
									</a>
								</div>
								<div class="col-lg-3 pull-right">
									<a href="{{ url('students/show', [$show_student->user_id]) }}"> Details </a>
								</div>
							</div>
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