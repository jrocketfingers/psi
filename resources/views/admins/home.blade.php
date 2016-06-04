@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Admin options</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-5">
                                <a href="{{ action('AdminsController@showAllUsers') }}">Edit users</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-5">
                                <a href="{{ action('RolesController@index') }}">Edit roles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection