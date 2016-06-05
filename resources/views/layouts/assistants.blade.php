@extends('layouts.app')

@section('details')
    <li><a href="{{ action('AssistantsController@showDetails') }}" ><i class="fa fa-btn fa-info"></i>Details</a></li>
    <li><a href="{{ action('AssistantsController@index') }}" ><i class="fa fa-btn fa-info"></i>Assistant options</a></li>
@endsection
