@extends('admin.layouts.master')

@section('title')
  Xem chi tiết sản phẩm: {{$model->name}}
@endsection

@section('content')
 <table>
    <tr>
        <th>thông tin</th>
        <th>giá trị</th>
    </tr>
    @foreach($model->toArray() as $key => $value )
    <tr>
        <td>{{$key}}</td>
        <td>
            @php
            if($key =='cover'){
                $url = \Storage::url($value);
                echo "<img src=\"$url\" alt=\"\" width=\"50px\">";

            } elseif(\Str::contains('is_', $key)) {
                echo $value;
            } else {
                echo $value;
            }
            @endphp
        </td>
    </tr>
    @endforeach
 </table>
@endsection
