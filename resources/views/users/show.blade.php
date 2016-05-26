@extends('layouts.app')

@section('content')
    {{ $user->name }}
    {{ $user->email }}
@endsection