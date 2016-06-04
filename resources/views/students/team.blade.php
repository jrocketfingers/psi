@extends('layouts.students')


@section('content')

<div class="container-fluid">
	<div class="row'">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title text-center"> {{ $team->name }} </h3>
				</div>
				<div class="panel-body">
					<h4 class="text-center"> Members </h4>
					<div class="text-center">
						@foreach ($team->students as $team_student)
							<a class="label label-default" href="{{ url('students/show', [$team_student->user->id]) }}"> {{ $team_student->user->name }} </a>
						@endforeach
					</div>
					

					<h4 class="text-center"> Project Name </h4>
					<p class="text-center"> {{ $team->project_name }} </p>

					<h4 class="text-center"> Project Description </h4>

					<p class="text-center"> {{ $team->description }} </p>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection