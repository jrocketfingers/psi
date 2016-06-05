@extends('layouts.admins')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="row" style="padding-bottom: 0.5em;">
                    <div class="col-md-6 col-md-offset-3">
                        {{ Form::open([ 'action' => 'AdminsController@searchUsers', 'method' => 'GET']) }}
                        <!-- <input type="text"  name="searchTerm" placeholder="Search"/> -->
                        <div class="form-group">
                            <div class="col-md-10">
                                {{ Form::text('searchTerm', 'Search', ['class' => 'form-control']) }}
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-large fa fa-search" type="submit"></button>
                            </div>
                        </div>

                        {{ Form::close() }}

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                          <h3 class="panel-title text-center">
                               Users
                          </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        @foreach($users as $user)
                            <div class="row">
                                <div class="col-md-9">
                                    {{ $user->name }}
                                </div>
                                <div class="col-md-3">
                                    <form class="form-group" role="form" method="POST" action="{{ action('AdminsController@destroyUser', [$user->id]) }}">
                                        {{ csrf_field() }}
                                        <input class="form-control btn btn-danger" type="submit" value="Delete">
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection