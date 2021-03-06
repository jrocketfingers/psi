@extends('layouts.students')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-5">
							<h3 class="panel-title">Profile Info</h3>
						</div>

						@if ($show_student->user_id == Auth::user()->id)
							<div class="col-lg-1 pull-right">
								<a href="{{ url('students/edit', [$show_student->user->id]) }}">Edit</a>
							</div>
						@endif
                        @if ($student->can_vote_for($show_student))
							<div class="col-lg-2 pull-right">
								<a href="{{ action('KicksController@create', [$show_student->user->id]) }}">Kick Vote</a>
							</div>

							<div class="col-lg-3 pull-right">
								<a href="{{ action('LeaderChangesController@create', [$show_student->user->id]) }}">Promote Leader Vote</a>
							</div>
						@endif
						@if(!$show_student->team && !($show_student->team == $student->team) && $student->team && $student->is_leader)
							<div class="col-lg-1 pull-right">
								<a href="{{ action('InvitesController@create', [$show_student->user->id]) }}">Invite</a>
							</div>
						@endif
						
					</div>
				</div>
				<div class="panel-body">
					@if($show_student->user->image)
						<div class="row">
							<div class="col-md-6 col-md-offset-3 text-center" style="padding-bottom: 2em;">
								<img class="img img-responsive" src="data:image;base64,{{ $show_student->user->image->image }}">
							</div>
						</div>
					@endif
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2">
							<div class="row">
								<div class="col-lg-4 col-lg-offset-2 text-center">
									<label>Username </label>
								</div>
								<div class="col-lg-4 text-center"> 
									<label>Email </label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-lg-offset-2 text-center">
									
									<div> {{ $show_student->user->name }} </div>
								</div>
								<div class="col-lg-4 text-center"> 
									<div> {{ $show_student->user->email }} </div>
								</div>
							</div>
						</div>
						@if($show_student->roles)
							<div class="col-md-8 col-md-offset-2 text-center" style="padding-top: 1em; padding-bottom:1em;">
								<label>Roles</label>
							</div>

							<div class="col-md-8 col-md-offset-2">
								<div class="row" style="text-align: center;">
									@foreach($show_student->roles as $role)
	                                    <a href="{{ url('students/role', [$role->id]) }}" class="label label-default" style="margin-left:0.5em; margin-right:0.5em;">
											{{ $role->name }}
										</a>
							        @endforeach

								</div>
							</div>
						@endif
					</div>
				</div>

		
			</div>
		</div>
	</div>
</div>
@endsection
