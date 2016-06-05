@extends('layouts.admins')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Admin options</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row" style="padding-bottom: 0.5em;">
                            <div class="col-md-4 col-md-offset-4">
                                <a href="{{ action('AdminsController@showAllUsers') }}" class="btn btn-primary btn-block">Edit users</a>
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 0.5em;">
                            <div class="col-md-4 col-md-offset-4">
                                <a href="{{ action('AdminsController@getAllRoles') }}" class="btn btn-primary btn-block">Edit roles</a>
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 0.5em;">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <a href="{{ action('AdminsController@showAllNotifications') }}" class="btn btn-primary btn-block">Notification log</a>
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 0.5em;">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <a href="{{ action('AdminsController@showAllRequests') }}" class="btn btn-primary btn-block">Request log</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection