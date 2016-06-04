@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                           <div class="col-md-6 text-center">
                               <h3 class="panel-title text-center">
                                   Users
                               </h3>
                           </div>
                            <div class="col-sm-4 text-right">
                                <a href="{{ action('AdminsController@index') }}">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @foreach($users as $user)
                            <div class="row">
                                <div class="col-md-6">
                                    {{ $user->name }}
                                </div>
                                <div class="col-md-6 text-right">
                                    <form class="form-group" role="form" method="POST" action="{{ url('/admins/destroyUser/'.$user->id) }}">
                                        <input class="form-group" type="submit" value="Delete">
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