@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            Notifications
                        </h3>
                    </div>
                    <div class="panel-body">
                        @foreach($notifications as $notification)
                            <div class="row">
                                <div class="col-lg-6">
                                    Notification: {{ $notification->id }}
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    <a href="{{ action('AdminsController@showNotificationDetails', [$notification->id]) }}" class="label label-default">
                                        Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection