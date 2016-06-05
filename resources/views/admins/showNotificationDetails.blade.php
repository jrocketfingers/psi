@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            Notification: {{ $notification->id }}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-2">
                                Text:
                            </div>
                            <div class="col-lg-4 col-lg-offset-2">
                                {{ $notification->text }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-2">
                                Seen: 
                            </div>
                            <div class="col-lg-4 col-lg-offset-2">
                                {{ $notification->seen ? 'Yes' : 'No' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-2">
                                For student:
                            </div>
                            <div class="col-lg-4 col-lg-offset-2">
                                {{ $notification->student->user->name }}
                            </div>
                        </div>
                        @if($notification->request != null)
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2">
                                    Request:
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    <a href="{{ action('AdminsController@showRequestDetails', [$notification->request->id]) }}" class="label label-primary">{{ 'Request:' . $notification->request->id }}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection