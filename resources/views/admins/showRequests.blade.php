@extends('layouts.admins')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            Requests
                        </h3>
                    </div>
                    <div class="panel-body">
                        @foreach($requests as $request)
                            <div class="row">
                                <div class="col-lg-6 text-center">
                                    Request: {{ $request->id }}
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="{{ action('AdminsController@showRequestDetails', [$request->id]) }}">
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