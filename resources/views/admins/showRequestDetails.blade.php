@extends('layouts.app')

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
                            <div class="col-lg-4 col-lg-offset-2">
                                Status:
                            </div>
                            <div class="col-lg-4 col-lg-offset-2">
                                {{ $request->status }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-2">
                                Inititated by:
                            </div>
                            <div class="col-lg-4 col-lg-offset-2">
                                {{ $request->student->user->name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-2">
                                Notifications:
                            </div>
                            <div class="col-lg-4 col-lg-offset-2">
                                @foreach($request->notifications as $notification)
                                    <a href="{{ action('AdminsController@showNotificationDetails', [$notification->id]) }}" class="label label-default">
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