@extends('layouts.app')


@section('details')
<li><a href="{{ action('StudentsController@show', [Auth::user()->id]) }}" ><i class="fa fa-btn fa-info"></i>Details</a></li>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('students/edit') }}">
                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ $student->id }}">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $student->name }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ $student->email }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Delete Role</label>
                                <div class="col-lg-6">
                                    {{ Form::select('delete_role_id[]', $personal_roles, null, array('class' => 'form-control', 'multiple' => 'multiple')) }} 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Add Role </label>
                                <div class="col-lg-6">
                                    {{ Form::select('add_role_id[]', $missing_roles, null, array('class' => 'form-control', 'multiple' => 'multiple')) }} 
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Submit changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection