@extends('layouts.app')

@section('details')
    <li><a href="{{ action('AdminsController@index', [Auth::user()->id]) }}" ><i class="fa fa-btn fa-info"></i> Admin Options </a></li>
@endsection
