@extends('layouts.app')

@section('content')
    <table>
        <div class="container">
            @foreach($users as $user)
                <div class="row">
                    <div class="col-sm-4">
                        {{ $user->name }}
                    </div>
                    <div class="col-sm-4">
                        <form class="form-group" role="form" method="POST" action="{{ url('/users/destroy/'.$user->id) }}">
                            <input class="form-group" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </table>
@endsection