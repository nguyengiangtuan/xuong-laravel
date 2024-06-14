@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Giỏ hàng') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(count($cart) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $details)
                                    <tr>
                                        <td><img src="{{ $details['img_thumbnail'] }}" width="50" height="50" class="img-fluid"></td>
                                        <td>{{ $details['name'] }}</td>
                                        <td>{{ $details['price'] }}</td>
                                        <td>{{ $details['quantity'] }}</td>
                                        <td>{{ $details['price'] * $details['quantity'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>{{ __('Giỏ hàng của bạn đang trống.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
