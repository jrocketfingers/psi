@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="panel-title text-center">Roles</h3>
                            </div>
                            <div class="col-lg-3 pull-right">
                                <a href="{{ action('AdminsController@createRole') }}">Add new role</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @foreach($roles as $role)
                            <div class="row">
                                <div class="col-lg-6">
                                    {{ $role->name }}
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <form  role="form" method="POST" action="{{ action('AdminsController@destroyRole', [$role->id]) }}" >
                                        {!! csrf_field() !!}
                                        <input type="submit" value="Delete">
                                    </form>
                                </div>
                                <div class="col-lg-3 pull-right">
                                    <a href="{{ action('AdminsController@showRole', [$role->id]) }}">Show Details</a>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection