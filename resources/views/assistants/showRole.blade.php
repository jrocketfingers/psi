@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="panel-title text-center">Role</h3>
                            </div>
                            <div class="col-lg-3 pull-right">
                                <a href="{{ action('RolesController@index') }}">Back</a>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="{{ action('RolesController@edit', [$role->id]) }}">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-2">
                                <div class="row">
                                    <div class="col-lg-4 col-lg-offset-2">
                                        <span>Role name:</span>
                                    </div>
                                    <div class="col-lg-4 col-lg-offset-2">
                                        {{ $role->name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-lg-offset-2">
                                        <span>Role description:</span>
                                    </div>
                                    <div class="col-lg-4 col-lg-offset-2">
                                        {{ $role->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
