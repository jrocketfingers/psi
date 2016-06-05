@extends('layouts.admins')

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
                            <label class="col-lg-6 text-center">
                                Text
                            </label>
                            <div class="col-lg-6 text-left">
                                {{ $notification->text }}
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg-6 text-center">
                                Seen
                            </label>
                            <div class="col-lg-6 text-left">
                                {{ $notification->seen ? 'Yes' : 'No' }}
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg-6 text-center">
                                For student
                            </label>
                            <div class="col-lg-6 text-left">
                                {{ $notification->student->user->name }}
                            </div>
                        </div>
                        @if($notification->request != null)
                            <div class="row">
                                <label class="col-lg-6 text-center" style="margin-top: 0.4em;">
                                    Request
                                </label>
                                <div class="col-lg-6 text-left">
                                    <a href="{{ action('AdminsController@showRequestDetails', [$notification->request->id]) }}" class="btn  btn-primary">{{ 'Request:' . $notification->request->id }}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection