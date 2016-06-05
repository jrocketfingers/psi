@extends('layouts.students')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">Team applications</div>
              <div class="panel-body">
                <h4>If you have applied to any teams you can see them listed here.</h4>
              </div>

              <!-- List group -->
              <div class="list-group">
                  @foreach($applications as $application)
                      <a href="#"
                         class="list-group-item">{{ $application->team->name }}</a>
                  @endforeach
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
