@extends('master')
@section('content')

{{--book name--}}

<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label @error('name') text-danger @enderror">Tên</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $book->name ?? null }}">
        @error('name')
        <div class="text-danger"></div>
        @enderror
    </div>
</div>

{{--Loai sach--}}


<div class="form-group row">
    <label class="col-sm-2 col-form-label">Loại sản phẩm </label>
    <div class="col-sm-5">
        <select class="browser-default custom-select mr-sm-0" name="loaisach_id">
            @foreach(\App\Models\ProductType::pluck('name', 'id')->toArray() as $key => $value)
                <option value="{{ $key }}" {{ ((old('loaisach_id') ?? $book->loaisach_id ?? 0) == $key) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>

{{--image--}}
<div class="form-group row">
    <label for="image" class="col-md-2 col-form-label">Hình ảnh </label>
    <div class="col-md-5">
        <input id="image" type="file" name="image">
    </div>
</div>


{{-- Unit price --}}
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label @error('price') text-danger @enderror">Unit Price</label>
    <div class="col-sm-5">
        <input type="number" step="1000" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') ?? $book->price ?? null }}">
        @error('price')
        <div class="text-danger"></div>
        @enderror
    </div>
</div>

{{--promotion price --}}
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label @error('price') text-danger @enderror">Promotion Price</label>
    <div class="col-sm-5">
        <input type="number" step="1000" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') ?? $book->price ?? null }}">
        @error('price')
        <div class="text-danger"></div>
        @enderror
    </div>
</div>



{{--describe--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('desc') text-danger @enderror">Mô tả</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('desc') is-invalid @enderror" id="article-ckeditor" name="desc">{{ old('desc') ?? $book->desc ?? null }}</textarea>
        @error('desc')
        <div class="text-danger"></div>
        @enderror
    </div>
</div>


    @endsection
