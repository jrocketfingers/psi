@extends('layouts.assistants')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            <h3 class="panel-title text-center">Profile Info</h3>
                        </div>
                        
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    <label>Username </label>
                                </div>
                                <div class="col-lg-4 text-center"> 
                                    <label>Email </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-2 text-center">
                                    
                                    <div> {{ $student->user->name }} </div>
                                </div>
                                <div class="col-lg-4 text-center"> 
                                    <div> {{ $student->user->email }} </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8 col-md-offset-2 text-center" style="padding-top: 1em; padding-bottom:1em;">
                            <label>Roles</label>
                        </div>

                        <div class="col-md-8 col-md-offset-2">
                            <div class="row" style="text-align: center;">
                                @foreach($student->roles as $role)
                                    <div class="label label-default">
                                        {{ $role->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

        
            </div>
        </div>
    </div>
</div>
@endsection