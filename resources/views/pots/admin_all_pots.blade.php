@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($pots as $pot)
    <div>
        <img src="{{url($pot->image)}}"/>
        <div>
            <div>{{$pot->name}}</div>
            <div>{{$pot->price}}</div>
            <div>{{$pot->dimesion_length}} cm x {{$pot->dimesion_width}} cm x {{$pot->dimesion_height}} cm</div>
        </div>
    </div>
    @endforeach
</div>
@endsection
