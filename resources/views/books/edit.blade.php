@extends('master')
@section('content')
	 <br>
    <h1>Edit Book</h1>
   <br>
   <br>
    
    <form action="{{ route('editPost', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
      {{--book name--}}

<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label @error('name') text-danger @enderror">Tên</label>
    <div class="col-sm-5">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $data->name}}">
        @error('name')
        <div class="text-danger">{{ $data->name }}</div>
        @enderror
    </div>
</div>


{{--Loai sach--}}


<div class="form-group row">
    <label class="col-sm-2 col-form-label">Loại sản phẩm </label>
    <div class="col-sm-5">
        <select class="browser-default custom-select mr-sm-0" name="id_type" required>
            @foreach(\App\Models\ProductType::pluck('name', 'id')->toArray() as $key => $value)
            <option value="{{ $key }}" {{ ((old('id_type') ?? $data->id_type ?? 0) == $key) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>




{{--image--}}
<div class="form-group row">
    <label for="image" class="col-md-2 col-form-label">Hình ảnh </label>
    <div class="col-md-5">
        <input  type="file" id = "image" name="image" value = "{{ $data->image}}">
    </div>
</div>


{{-- Unit price --}}
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label @error('price') text-danger @enderror">Đơn giá </label>
    <div class="col-sm-5">
        <input type="number" step="1000" class="form-control @error('price') is-invalid @enderror" name="unit_price" value="{{ old('price') ?? $data->unit_price ?? null }}">
        @error('price')
        <div class="text-danger"></div>
        @enderror
    </div>
</div>

{{--promotion price --}}
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label @error('price') text-danger @enderror">Giá khuyến mãi</label>
    <div class="col-sm-5">
        <input type="number" step="1000" class="form-control @error('price') is-invalid @enderror" name="promotion_price" value="{{ old('price') ?? $data->promotion_price ?? null }}">
        @error('price')
        <div class="text-danger"></div>
        @enderror
    </div>
</div>



{{--describe--}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label @error('desc') text-danger @enderror">Mô tả</label>
    <div class="col-sm-5">
        <textarea class="form-control @error('desc') is-invalid @enderror" name="description">{{ old('desc') ?? $data->description ?? null }}</textarea>
        @error('desc')
        <div class="text-danger"></div>
        @enderror
    </div>
</div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">EDIT BOOK</button>
        </div>
    </form>


    @endsection
