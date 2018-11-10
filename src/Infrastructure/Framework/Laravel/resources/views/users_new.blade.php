@extends('index')

@section('content')
    <form action="{{ url('/users') }}" method="post">
        @csrf
        <div class="width-350" style="margin-top: 100px">
            <div class="form-title">
                Name
            </div>
            <div class="form-text">
                <input type="text" name="name" />
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="width-350">
            <div style="float: right">
                <input type="submit" value="Save" style="border: solid 1px; width: 80px" />
            </div>
            <div style="clear: both"></div>
        </div>
    </form>
@endsection