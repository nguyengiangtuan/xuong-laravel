@extends('admin.layouts.master')

@section('title')
  Danh sách sản phẩm
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">Thêm mới</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">sản phẩm</a></li>
            <li class="breadcrumb-item active">Basic Elements</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
 <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
 @csrf
 <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header align-items-center d-flex">
          <h4 class="card-title mb-0 flex-grow-1">Input Example</h4>
          <div class="flex-shrink-0">
            <div class="form-check form-switch form-switch-right form-switch-md">
              <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
              <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="live-preview">
            <div class="row gy-4">
              <div class="col-xxl-3 col-md-4">
                <div class="mt-3">
                  <label for="Name" class="form-label">NAME</label>
                  <input type="text" class="form-control" id="Name" name="name">
                </div>
                <div class="mt-3">
                  <label for="sku" class="form-label">Sku</label>
                  <input type="text" class="form-control" id="sku" name="sku" value="{{\Str::random(8)}}">
                </div>
                <div class="mt-3">
                  <label for="price_regular" class="form-label">price_regular</label>
                  <input type="number" class="form-control" id="price_regular" name="price_regular" value="0">
                </div>
                <div class="mt-3">
                  <label for="price_sale" class="form-label">price_sale</label>
                  <input type="number" class="form-control" id="price_sale" name="price_sale" value="0">
                </div>
                <div class="mt-3">
                  <label for="Name" class="form-label">Catelogues</label>
                  <select name="catelogue_id" id="catelogue_id" class="form-select">
                    @foreach($catelogue as $id => $name)
                      <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-3">
                  <label for="img_thumbnail" class="form-label">img_thumbnail</label>
                  <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
                </div>
              </div>
              
              <div class="col-xxl-3 col-md-8">
                <div class="row">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="is_active" checked>
                    <label class="form-check-label" for="is_active">is_active</label>
                  </div>
                  <div class="form-check form-switch form-switch-dark">
                    <input class="form-check-input" type="checkbox" role="switch" name="is_hot_deal" id="is_hot_deal" checked>
                    <label class="form-check-label" for="is_hot_deal">is_hot_deal</label>
                  </div>
                  <div class="form-check form-switch form-switch-secondary">
                    <input class="form-check-input" type="checkbox" role="switch" name="is_good_deal" id="is_good_deal" checked>
                    <label class="form-check-label" for="is_good_deal">is_good_deal</label>
                  </div>
                  <div class="form-check form-switch form-switch-success">
                    <input class="form-check-input" type="checkbox" role="switch" name="is_new" id="is_new" checked>
                    <label class="form-check-label" for="is_new">is_new</label>
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="is_show_home" id="is_show_home" checked>
                    <label class="form-check-label" for="is_show_home">is_show_home</label>
                  </div>
                </div>
                
                <div class="row">
                  <div class="mt-3">
                    <label for="description" class="form-label">description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                  </div>
                  <div class="mt-3">
                    <label for="material" class="form-label">material</label>
                    <textarea class="form-control" name="material" id="material" rows="3"></textarea>
                  </div>
                  <div class="mt-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row" style="height:300px; overflow:scroll " >
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header align-items-center d-flex">
          <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>
        </div>
        <div class="card-body">
          <div class="live-preview">
            <div class="row gy-4">
              <table class="table">
                <thead>
                  <tr>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Image</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($size as $sizeID => $sizeName)
                    @foreach($color as $colorID => $colorName)
                      <tr>
                        <td>{{$sizeName}}</td>
                        <td>{{$colorName}}</td>
                        <td><input type="text" class="form-control"name="product_variants{{$sizeID.'-'.$colorID}}[quantity]"></td>
                        <td><input type="file" class="form-control"name="product_variants{{$sizeID.'-'.$colorID}}[image]"></td>
                      </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header align-items-center d-flex">
          <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
          <div class="flex-shrink-0">
            <div class="form-check form-switch form-switch-right form-switch-md">
              <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
              <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="live-preview">
            <div class="row gy-4">
              <div class="col-xxl-3 col-md-4">
                <div class="mt-3">
                  <label for="Name" class="form-label">Gallery_1</label>
                  <input type="file" class="form-control" id="gallery_1" name="product_galleries[]">
                </div>
                <div class="mt-3">
                  <label for="Name" class="form-label">Gallery_2</label>
                  <input type="file" class="form-control" id="gallery_2" name="product_galleries[]">
                </div> 

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header align-items-center d-flex">
          <h4 class="card-title mb-0 flex-grow-1">Tag</h4>
          <div class="flex-shrink-0">
            <div class="form-check form-switch form-switch-right form-switch-md">
              <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
              <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="live-preview">
            <div class="row gy-4">
              <div class="col-xxl-3 col-md-4">
                <div class="mt-3">
                  <label for="Name" class="form-label">Tag</label>
                  <select class="form-select" name="tag[]" id="tag" multiple>
                        @foreach($tag as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                      </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header align-items-center d-flex">
        <button class="btn btn-primary" type="submit">Save</button>

        </div>
      </div>
    </div>
  </div>
 </form>
@endsection

@section('script-libs')
  <script src="https://cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection

@section('scripts')
  <script>
    CKEDITOR.replace('content');
  </script>
@endsection
