@extends('index')

@section('content')
    <table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border: solid 1px #ccc">
        <th style="width: 50px">ID</th>
        <th style="width: 200px">Name</th>
        <th style="width: 50px">Action</th>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id() }}</td>
                <td>{{ $user->name() }}</td>
                <td><a id="link_to_edit_user_{{$user->id()}}" href="{{ url('users/'.$user->id()) }}">edit</a></td>
            </tr>
        @endforeach
    </table>
@endsection
