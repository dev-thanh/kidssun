<?php 
    $start_date = request()->startdate ? request()->startdate : '';
    $end_date = request()->enddate ? request()->enddate : '';
?>
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
    .btn-success {
        font-size: 16px;
        padding: 8px 10px;
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

                        <div class="tab-pane active" id="activity" >
                            <div>
                                <div class="col-sm-2" style="padding: 5px">                 
                                    <label for="">Ngày tạo</label>              
                                </div>
                                <div class='col-sm-3'>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <label class="input-group-addon" for="startDate">
                                                Từ ngày
                                            </label>
                                            <input type='text' value="{{$start_date}}" class="form-control" readonly id="startDate" name="start_date" placeholder="Từ ngày" />
                                            <label class="input-group-addon" for="startDate">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-sm-3'>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker2'>
                                            <label class="input-group-addon" for="endDate">
                                                Đến ngày
                                            </label>
                                            <input type='text' value="{{$end_date}}" class="form-control" readonly placeholder="Đến ngày" id="endDate" name="end_date"/>
                                            <label class="input-group-addon" for="endDate">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-sm btn-success" id="filter_date" data-href="{{route('orders.edit',['id'=>$order->order_id])}}">Tìm</button>
                                </div>
                                <table id="table1">
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table1').DataTable( {      
                 "searching": false,
                 "paging": true, 
                 "info": false,         
                 "lengthChange":false 
            } );
        });
        var bindDateRangeValidation = function (f, s, e) {
        if(!(f instanceof jQuery)){
                console.log("Not passing a jQuery object");
        }
      
        var jqForm = f,
            startDateId = s,
            endDateId = e;
      
        var checkDateRange = function (startDate, endDate) {
            var isValid = (startDate != "" && endDate != "") ? startDate <= endDate : true;
            return isValid;
        }

        var bindValidator = function () {
            var bstpValidate = jqForm.data('bootstrapValidator');
            var validateFields = {
                startDate: {
                    validators: {
                        notEmpty: { message: 'This field is required.' },
                        callback: {
                            message: 'Start Date must less than or equal to End Date.',
                            callback: function (startDate, validator, $field) {
                                return checkDateRange(startDate, $('#' + endDateId).val())
                            }
                        }
                    }
                },
                endDate: {
                    validators: {
                        notEmpty: { message: 'This field is required.' },
                        callback: {
                            message: 'End Date must greater than or equal to Start Date.',
                            callback: function (endDate, validator, $field) {
                                return checkDateRange($('#' + startDateId).val(), endDate);
                            }
                        }
                    }
                },
                customize: {
                    validators: {
                        customize: { message: 'customize.' }
                    }
                }
            }
            if (!bstpValidate) {
                jqForm.bootstrapValidator({
                    excluded: [':disabled'], 
                })
            }
          
            jqForm.bootstrapValidator('addField', startDateId, validateFields.startDate);
            jqForm.bootstrapValidator('addField', endDateId, validateFields.endDate);
          
        };

        var hookValidatorEvt = function () {
            var dateBlur = function (e, bundleDateId, action) {
                jqForm.bootstrapValidator('revalidateField', e.target.id);
            }

            $('#' + startDateId).on("dp.change dp.update blur", function (e) {
                $('#' + endDateId).data("DateTimePicker").setMinDate(e.date);
                dateBlur(e, endDateId);
            });

            $('#' + endDateId).on("dp.change dp.update blur", function (e) {
                $('#' + startDateId).data("DateTimePicker").setMaxDate(e.date);
                dateBlur(e, startDateId);
            });
        }

        bindValidator();
        hookValidatorEvt();
    };


    $(function () {
        var sd = @if($start_date !='') '{{$start_date}}' @else new Date() @endif;
        var ed = new Date();
      
        $('#startDate').datetimepicker({ 
          pickTime: false, 
          format: "DD-MM-YYYY", 
          //defaultDate: @if(@$stdf) '{{@$stdf}}' @else sd @endif, 
          maxDate: ed 
        });
      
        $('#endDate').datetimepicker({ 
          pickTime: false, 
          format: "DD-MM-YYYY", 
          //defaultDate: @if(@$endf) '{{@$endf}}' @else ed @endif,
          minDate: sd 
        });

        //passing 1.jquery form object, 2.start date dom Id, 3.end date dom Id
        bindDateRangeValidation($("#form"), 'startDate', 'endDate');
    });
    $('#filter_date').on('click',function(){
        var url = $(this).data('href');

        var startdate = $('#startDate').val();
        var enddate = $('#endDate').val();
        if(startdate !='' || enddate !=''){
            window.location.href = url+'?startdate='+startdate+'&enddate='+enddate;
        }
        // console.log(startdate);
        // $.ajax({
  //           url: url,
  //           type: 'GET',
  //           data: {startdate: startdate,enddate:enddate},
  //       }).done(function(data) {
  //        console.log(data);
    //  });
    });
    </script>
@stop
