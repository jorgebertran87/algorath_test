@extends('index')

@section('content')
    <table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border: solid 1px #ccc">
        <th style="width: 50px">ID</th>
        <th style="width: 200px">Name</th>
        <th style="width: 50px">Connections</th>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id() }}</td>
                <td>{{ $user->name() }}</td>
                @if($user->connections()->count() > 0)
                    <td>
                        {{ round(($user->connections()->count()*100)/($users->count()-1), 2) }} %
                    </td>
                @else
                    <td>0 %</td>
                @endif
            </tr>
        @endforeach
    </table>
@endsection
