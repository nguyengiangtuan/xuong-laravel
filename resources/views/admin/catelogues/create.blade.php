@extends('admin.layouts.master')

@section('title')
  Thêm mới danh mục sản phẩm 
@endsection

@section('content')
<form action="{{ route('admin.catelogues.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="mb-3">
    <label for="cover" class="form-label">Cover</label>
    <input type="file" class="form-control" id="cover" name="cover">
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
    <label class="form-check-label" for="is_active">
      Is Active
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
