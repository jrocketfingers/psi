@extends('layouts.app')

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
                                <div class="col-lg-6">
                                    Request: {{ $request->id }}
                                </div>
                                <div class="col-lg-4 col-lg-offset-2">
                                    <a href="{{ action('AdminsController@showRequestDetails', [$request->id]) }}" class="label label-default">
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