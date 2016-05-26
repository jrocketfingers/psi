@extends('layouts.app')

@section('content')
    <table>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>
                    <form class="form-control" role="form" method="POST" action="{{ url('users/destroy/'.$user->id) }}" >
                        {!! csrf_field() !!}
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection