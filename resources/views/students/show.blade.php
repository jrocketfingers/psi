@extends('layouts.students')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-6">
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
						
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4">
							<div class="row">
								<div class="col-lg-4 col-lg-offset-2">
									<span>Username: </span>
								</div>
								<div class="col-lg-4 col-lg-offset-2"> 
									<div> {{ $show_student->user->name }} </div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-lg-offset-2">
									<span>Email: </span>
								</div>
								<div class="col-lg-4 col-lg-offset-2"> 
									<div> {{ $show_student->user->email }} </div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-lg-offset-2">
							<div class="row" style="text-align: center;">
								@foreach($show_student->roles as $role)
									<div class="label label-default">
										{{ $role->name }}
									</div>
						        @endforeach
							</div>
						</div>
					</div>
				</div>

		
			</div>
		</div>
	</div>
</div>
@endsection
