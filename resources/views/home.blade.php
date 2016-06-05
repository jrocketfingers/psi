@extends('layouts.app')

@section('content')
<div class="container">

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
