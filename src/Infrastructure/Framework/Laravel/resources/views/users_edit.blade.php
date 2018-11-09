@extends('index')

@section('content')
    <form action="{{ url('/users/'.$user->id().'') }}" method="post">
        @csrf
        <div class="width-350" style="margin-top: 100px">
            <div class="form-title">
                Name
            </div>
            <div class="form-text">
                <input type="text" name="name" value="{{ $user->name() }}" />
            </div>
            <div style="clear: both"></div>
        </div>
        @if ($users->count() > 1)
        <div class="width-350">
            <div class="form-title">
                Connections
            </div>
            <div class="form-text">
                <select name="connections[]" multiple>
                    @foreach ($users as $us)
                        @if (!$us->equals($user))
                            <option {{ $connections->exists($us) ? 'selected' : '' }} value="{{ $us->id() }}">{{ $us->name() }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div style="clear: both"></div>
        </div>
        @endif
        <div class="width-350">
            <div style="float: right">
                <input type="submit" value="Save" style="border: solid 1px; width: 80px" />
            </div>
            <div style="clear: both"></div>
        </div>
    </form>
@endsection