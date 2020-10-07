<?php 
    $month = request()->month && request()->month !='' ? request()->month : now()->month;
    $year = request()->year && request()->year !='' ? request()->year : now()->year;
?>
@extends('backend.layouts.app')
@section('controller','Tính lương')
@section('action','Danh sách')
@section('content')
    <style type="text/css" media="screen">
        table .hoan-thanh{
            background-color: #6bd9a6 !important
        }
    </style>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
                <div class="alert alert-danger">
                    <span><b> Chú ý:</b> Lương sau khi hoàn tất sẽ không chỉnh sửa được!</span>
                </div>
                <div class="row">
                    <div style="font-size: 18px;padding: 0px 15px;display: inline-flex;">
                      <label style="margin-right: 10px">Năm:
                        <select id="yearSelector" class="get-year">
                          <option value="2020" selected="selected">2020</option>
                        </select>
                      </label>
                      <label>Tháng:
                        <select id="monthSelector">
                            @for($i=01;$i<13;$i++)
                            @if($i < 10)
                            <option value="0{{$i}}" @if($month==$i) selected @endif>{{$i}}</option>
                            @else
                            <option value="{{$i}}" @if($month==$i) selected @endif>{{$i}}</option>
                            @endif
                          @endfor
                        </select>
                      </label>
                    </div>
                    <a href="{{route('orders.bang-luong')}}" title="">
                        
                        <button class="btn btn-primary" style="float: right;margin-right: 20px" type="">Danh sách</button>
                    </a>
                    </br>
                </div>

                <form action="{{route('orders.xac-nhan-luong')}}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="" id="url_chitiet_luong" value="{{route('orders.chi-tiet-luong',['id'=>@$member_info->id])}}">
                    <div style="padding: 0px 15px;margin-bottom: 20px;">
                        <h3 class="clearfix">{{@$member_info->full_name}}</h3>
                        <span>
                            {{@$member_info->link_aff}} - @if($member_info->code=='CTV') Cộng tác viên @elseif($member_info->code=='DLBL') Đại lý bán lẻ @elseif($member_info->code=='DLPP') Đại lý phân phối @endif
                        </span>
                    </div>
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Lương đã tính</label>
                        <input type="text" class="form-control" readonly="" disabled="" value="@if($luong_thang_hien_tai) {{number_format($luong_thang_hien_tai->money, 0, '.', '.')}}đ @else 0đ @endif">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Đang chờ</label>
                        <input type="text" class="form-control" readonly="" disabled="" value="{{number_format($data->where('active',0)->sum('money'), 0, '.', '.')}}đ">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Bù/trừ</label>
                        <input type="number" class="form-control" value="@if($luong_thang_hien_tai) {{number_format($luong_thang_hien_tai->bu_tru, 0, '.', '.')}}đ @endif" name="bu_tru">
                      </div>
                    </div>
                    <div class="col-md-3 pl-1">
                      <div class="form-group">
                        <label>Nội dung</label>
                        <input type="text" class="form-control" name="noi_dung">
                      </div>
                    </div>
                </div>
                <br>

                
               
                    <div class="form-group">
                        <div class="form-check">
                          <label class="form-check-label">
                            <!-- <input class="form-check-input" type="checkbox" value="" id="chkConfirm"> -->
                            @if(!$luong_thang_hien_tai)
                            <button class="btn btn-primary"  onclick="return confirm('Bạn có chắc chắn xác nhận ?')" class="form-check-sign">Xác nhận.</button>
                            @else
                            <span class="label label-success">Đã tính lương cho đại lý</span>
                            @endif
                          </label>
                        </div>
                    </div>

                    <input type="hidden" name="id_daily" value="{{$member_id}}">
                    <input type="hidden" name="money" value="{{$data->sum('money')}}">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hoa hồng từ</th>
                                <th>Mã đơn hàng</th>
                                <th>Số tiền</th>
                                <th>Ngày nhận</th>
                                <th>Trạng thái</th>
                                <th>Note</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr @if($item->active == 1) class="hoan-thanh" @endif>
                                <input type="hidden" name="checked_id[]" value="{{$item->id}}">
                                <td>{{ $loop->index +1 }}</td>
                                <td>
                                   {{ $item->name_capduoi !='' ? $item->name_capduoi : 'Doanh số nhập' }}
                                </td>
                                <td>{{ $item->id_donhang }}</td>
                                <td>{{number_format($item->money, 0, '.', '.')}}đ</td>
                                <td>{{format_datetime($item->ngay_nhan,'d-m-Y')}}</td>
                                <td>
                                    @if($item->active == 0) Đang chờ @else Đã hoàn thành @endif
                                </td>
                                <td>{{ $item->name_status }}</td>
                                
                                <!-- <td>
                                    <a href="" class="btn-destroy">
                                        <i class="fa fa-unlock-alt"></i> Xem
                                    </a>
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
           </div>
        </div>
    </div>
    @section('scripts')
    <script type="text/javascript">
        $('select').change(function () {
            var url = $('#url_chitiet_luong').val();
            var month = $(this).val();
            var year = $('.get-year').val();
            // var month = $('.get-month').val();
            window.location.href = url+'?year='+year+'&month='+month;
        });
    </script>
    @endsection
@stop