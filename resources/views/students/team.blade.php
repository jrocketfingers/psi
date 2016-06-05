@extends('layouts.students')


@section('content')

<div class="container-fluid">
	<div class="row'">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class = "row">
						<div class="col-lg-6">
							<h3 class="panel-title"> {{ $team->name }} </h3>
						</div>
						@if($student->is_leader == 1)
							<div class="col-lg-1 pull-right">
								<a href="{{ action('StudentsController@editTeam', ['id' => $team->id]) }}">Edit</a>
							</div>
						@endif
					</div>
				</div>
				<div class="panel-body">
					<h4 class="text-center"> Members </h4>
					<div class="text-center">
						@foreach ($team->students as $team_student)
							<a style="padding-right: 0.5em; padding-left: 0.5em;" class="btn btn-primary" href="{{ url('students/show', [$team_student->user->id]) }}"> {{ $team_student->user->name }} </a>
						@endforeach
					</div>
					

					<h4 class="text-center"> Project Name </h4>
					<p class="text-center"> {{ $team->project_name }} </p>

					<h4 class="text-center"> Project Description </h4>

					<p class="text-center"> {{ $team->description }} </p>


					<h4 class="text-center"> Roles </h4>
					<div class="col-md-8 col-md-offset-2">
						<div class="row" style="text-align: center;">
							@foreach($team->roles as $role)
								<div class="label label-default" style="margin-left: 0.5em; margin-right: 0.5em;">
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

@endsection