@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route('orders.index'))
@section('action', 'Chi tiết đơn hàng')
@section('content')
<style type="text/css" media="screen">
    table, td, th {  
      border: 1px solid #ddd;
      text-align: left;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      padding: 15px;
    }
    .form-group input{
        padding: 20px 10px;
        background-color: #ececff !important;
    }
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
    }
    .product-total {
        font-size: 25px;
        font-weight: 700;
        color: #f26824;
        letter-spacing: 0;
    }
</style>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                       <li class="active">
                               <a href="#activity" data-toggle="tab" aria-expanded="true">Chi tiết đơn hàng</a>
                        </li>
                        <li class="">
                            <a href="#activity1" data-toggle="tab" aria-expanded="true">Thông tin tài khoản khách hàng</a>
                        </li>
                        
                    </ul>

                     <div class="tab-content" >

                        <div class="tab-pane active" id="activity">
                            <div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center">Hình ảnh sản phẩm</th>
                                            <th class="text-center">Tên sản phẩm</th>
                                            <th class="text-center">Đơn giá</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-center">Thành tiền</th>
                                            <th class="text-center">Ngày mua</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_details as $k =>$item)
                                        <tr>
                                            <td class="text-center">{{$k+1}}</td>
                                            <td class="text-center"><img style="max-width: 100px; max-height: 100px; width: 100%; height: 100%;" src="{{url('/')}}{{$item->image}}" alt=""></td>
                                            <td class="text-center">{{$item->product_name}}</td>
                                            <td class="text-center">{{number_format($item->price, 0, '.', '.')}}đ</td>
                                            <td class="text-center">{{$item->qty}}</td>
                                            <td class="text-center">{{number_format($item->price_total, 0, '.', '.')}}đ</td>
                                            <td class="text-center">{{format_datetime($item->created_at,'d-m-Y')}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-footer">
                                <div class="button">
                                    @if($order->id_status == 1)                       
                                    <a href="{{route('orders.xac-nhan',['id'=>$order->order_id,'status'=>2])}}" onclick="return confirm('Bạn có chắc chắn đơn hàng đã hoàn thành ?')" >
                                        <button class="btn btn-primary" type="">Xác nhận đơn hàng đã hoàn thành</button>
                                    </a>
                                    
                                    <a href="{{route('orders.xac-nhan',['id'=>$order->order_id,'status'=>3])}}" onclick="return confirm('Bạn có chắc chắn hủy đơn hàng ?')" >
                                        <button class="btn btn-danger" type="">Hủy đơn hàng</button>
                                    </a>
                                    @elseif($order->id_status == 2)
                                        <label for="">Trạng thái đơn hàng</label>
                                        </br>
                                        <span class="label label-success">Đã hoàn thành</span>
                                    @else
                                        <label for="">Trạng thái đơn hàng</label>
                                        </br>
                                        <span class="label label-danger">Đã hủy</span>
                                    @endif
                                </div>
                                <div class="product-total">
                                    <label>Tạm tính:</label>
                                    <span class="total-cart">{{number_format($order->tongtien, 0, '.', '.')}}đ</span>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="activity1">
                            <div class="col-sm-6">
                                <!-- <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Mã đơn hàng</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            {{$order->mavd}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Trạng thái</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            Chờ báo giá
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Ngày đặt</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            {{format_datetime($order->created_at,'d-m-Y')}}
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group" style="margin-top: 30px">
                                    <label>Tên đầy đủ</label>
                                    <input type="text" class="form-control" value="{{@$order->full_name}}" readonly required="">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ email thành viên</label>
                                    <input type="text" class="form-control"value="{{@$order->email}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại đăng ký thành viên</label>
                                    <input type="text" class="form-control" value="{{@$order->phone}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Mã thành viên</label>
                                    <input type="text" class="form-control" id="name" value="{{@$order->link_aff}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" value="{{@$order->address}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
