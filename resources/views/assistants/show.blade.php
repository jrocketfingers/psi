@extends('layouts.assistants')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-11">
							<h3 class="panel-title">Profile Info</h3>
						</div>
						<div class="col-lg-1">
							<a href="{{ action('AssistantsController@editDetails') }}">Edit</a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4 col-lg-offset-2 text-center">
							<label>Username </label>
						</div>
						<div class="col-lg-4 text-center"> 
							<div> {{ Auth::user()->name }} </div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-lg-offset-2 text-center">
							<label>Email </label>
						</div>
						<div class="col-lg-4 text-center"> 
							<div> {{ Auth::user()->email }} </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
