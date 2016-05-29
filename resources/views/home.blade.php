@extends('layouts.app')

@section('content')
<div class="container">

    <!-- <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/users/destroy/'.Auth::user()->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i>Delete account
                        </button>
                    </form>
                    <br>
                    <a href="{{ action('UsersController@show', [Auth::user()->id]) }}" >Details</a>
                    <br>
                    @yield('user_content')
                </div>
            </div>
        </div>
    </div> -->
    @foreach ($teams as $team)
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $team->name }}
                    </div>
                    <div class="panel-body">
                        This is a Random Description
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
