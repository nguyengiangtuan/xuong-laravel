@extends('admin.layouts.master')

@section('title', 'Cập nhật danh mục sản phẩm: ' . $model->name)

@section('content')
<form action="{{ route('admin.catelogues.update', $model->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="name" class="form-label">Tên danh mục</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $model->name }}">
  </div>
  <div class="mb-3">
    <label for="cover" class="form-label">Ảnh đại diện</label>
    <input type="file" class="form-control" id="cover" name="cover">
    <img src="{{\Storage::url($model->cover)}}" alt=""width="50px">
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" {{ $model->is_active ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">
      Kích hoạt
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@endsection
