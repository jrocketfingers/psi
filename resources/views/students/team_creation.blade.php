@extends('layouts.students')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="{{ url('students/team/create') }}" method="POST" class="form-horizontal" role="form">
				{!! csrf_field() !!}
				<div class="form-group">
					<legend>Team Creation Form</legend>
				</div>

				<div class="form-group">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
						<span class="control-label">Name</span>
					</div>

					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						{{ Form::text('name', null, [ 'class' => 'form-control']) }}
					</div>

				</div>

				<div class="form-group">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
						<span class="control-label">Project Name</span>
					</div>

					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						{{ Form::text('project_name', null, [ 'class' => 'form-control']) }}
					</div>

				</div>

				<div class="form-group">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
						<span class="control-label">Description</span>
					</div>

					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						{{ Form::text('description', null, [ 'class' => 'form-control']) }}
					</div>

				</div>

				<div class="form-group">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
						<span class="control-label">Add Role</span>
					</div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                        {{ Form::select('add_role_id[]', $roles, null, array('class' => 'form-control', 'multiple' => 'multiple')) }} 
                    </div>
                </div>
		
				<div class="form-group">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection