@extends('layouts.students')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ action('StudentsController@storeTeam') }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ $team->id }}">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $team->name }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('project_name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Project name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="project_name" value="{{ $team->project_name }}">

                                    @if ($errors->has('project_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('project_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    {{ Form::textarea('description', $team->description, [ 'class' => 'form-control', 'style' => 'resize: none;', 'rows' => '5']) }}

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="image" >

                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
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