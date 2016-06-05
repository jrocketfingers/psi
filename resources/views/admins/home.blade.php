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
                        <div class="row">
                            <div class="col-md-6 col-md-offset-5">
                                <a href="{{ action('AdminsController@showAllUsers') }}" class="label label-primary">Edit users</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-5">
                                <a href="{{ action('AdminsController@getAllRoles') }}" class="label label-primary">Edit roles</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-5">
                                <a href="{{ action('AdminsController@showAllNotifications') }}" class="label label-primary">Notification log</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-5">
                                <a href="{{ action('AdminsController@showAllRequests') }}" class="label label-primary">Request log</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection