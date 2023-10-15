@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('status'))
        @if (session('status')['isSuccess'])
            <div class="alert alert-success mb-3">
                {{ session('status')['message'] }}
            </div>
        @else
            <div class="alert alert-alert mb-3">
                {{ session('status')['message'] }}
            </div>
        @endif
    @endif
    
    <div class="mb-3">
        <a href="{{ route('admin.pots.create') }}" class="btn btn-primary">
            Tạo chậu cảnh mới
        </a>
    </div>
    
    @foreach ($pots as $pot)
    <div>
        <img src="{{url($pot->image)}}"/>
        <div>
            <div>{{$pot->name}}</div>
            <div>{{$pot->price}} VNĐ</div>
            <div>{{$pot->dimesion_length}} cm x {{$pot->dimesion_width}} cm x {{$pot->dimesion_height}} cm</div>
        </div>
    </div>
    @endforeach
</div>
@endsection
