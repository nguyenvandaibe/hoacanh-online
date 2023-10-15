@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.pots.store') }}" enctype="multipart/form-data">
        
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Đặt tên cho chậu</label>
            <input type="text" class="form-control bg-white @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên chậu">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="length" class="form-label">Chiều dài (cm)</label>
            <input type="number" class="form-control bg-white @error('length') is-invalid @enderror" name="length" id="length" value="{{ old('length') !== null ? old('length') : 0 }}" min="1" max="10000"> cm
            @error('length')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="width" class="form-label">Chiều rộng (cm)</label>
            <input type="number" class="form-control bg-white @error('width') is-invalid @enderror" name="width" id="width" value="{{ old('width') !== null ? old('width') : 0 }}" min="1" max="10000">
            @error('width')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="height" class="form-label">Chiều cao (cm)</label>
            <input type="number" class="form-control bg-white @error('height') is-invalid @enderror" name="height" id="height" value="{{ old('height') !== null ? old('height') : 0 }}" min="1" max="10000">
            @error('height')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá (VNĐ)</label>
            <input type="number" class="form-control bg-white @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price') !== null ? old('price') : 0 }}" min="0">
            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="uploadedImage" class="form-label">Chọn ảnh</label>
            <input class="form-control bg-white @error('uploadedImage') is-invalid @enderror" type="file" id="uploadedImage" name="uploadedImage" accept="image/*">
            @error('uploadedImage')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary px-5">
                Lưu
            </button>
        </div>
    </form>
</div>
@endsection
