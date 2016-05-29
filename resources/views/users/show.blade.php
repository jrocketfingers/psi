@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-11">
							<h3 class="panel-title">Profile Info</h3>
						</div>
						<div class="col-lg-1">
							<a href="{{ action('UsersController@edit', [$user->id]) }}">Edit</a>
						</div>
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
									<div> {{ $user->name }} </div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-lg-offset-2">
									<span>Email: </span>
								</div>
								<div class="col-lg-4 col-lg-offset-2"> 
									<div> {{ $user->email }} </div>
								</div>
							</div>
							
						</div>
						@if(\App\Student::isStudent($user->id))
							<div class="col-lg-6 col-lg-offset-2">
								<div class="row" style="text-align: center;">
									@foreach($roles as $role)
							            <div class="col-lg-4 text-center">
							                <div class="label label-default"> {{ $role->name }} </div>
							            </div>
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
