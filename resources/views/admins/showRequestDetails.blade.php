@extends('layouts.admins')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            Request: {{ $request->id }}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 text-right">
                                <label>
                                    Status
                                </label>
                            </div>
                            <div class="col-lg-6 text-left">
                                {{ $request->status }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 text-right">
                                <label>
                                    Inititated by
                                </label>
                                
                            </div>
                            <div class="col-lg-6 text-left">
                                {{ $request->student->user->name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 text-right" style="margin: 0 auto; vertical-align: middle;">
                                <label>
                                    Notifications
                                </label>
                            </div>
                            <div class="col-lg-6 text-left">
                                @foreach($request->notifications as $notification)
                                    <a href="{{ action('AdminsController@showNotificationDetails', [$notification->id]) }}" class="btn btn-primary">
                                        {{ 'Notification: ' . $notification->id }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection