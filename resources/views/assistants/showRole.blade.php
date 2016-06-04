@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                                <h3 class="panel-title text-center">Role</h3>
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
