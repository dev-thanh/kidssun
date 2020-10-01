<?php 
    $month = date('m');
    $year = date('yy');
    $start_format = '01-'.$month.'-'.$year;
    $start_date = request()->startdate ? request()->startdate : $start_format;
    $end_date = request()->enddate ? request()->enddate : '';
?>
@extends('backend.layouts.app')
@section('controller','Lịch sử nhận hoa hồng')
@section('action','Danh sách')
@section('controller_route', route('orders.doanh-thu'))
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
                <!-- <div class="btnAdd">
                    <a href="{{ route('users.create') }}">
                        <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm thành viên</fa>
                    </a>
                </div> -->
                <div class="col-sm-2" style="padding: 5px">                 
                    <label for="">Ngày tạo</label>              
                </div>
                <div class='col-sm-3'>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker1'>
                            <label class="input-group-addon" for="startDate">
                                Từ ngày
                            </label>
                            <input type='text' value="{{@$start_date}}" class="form-control" readonly id="startDate" name="startDate" placeholder="Từ ngày" />
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
                            <input type='text' class="form-control" value="{{@$end_date}}" readonly placeholder="Đến ngày" id="endDate" name="endDate"/>
                            <label class="input-group-addon" for="endDate">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </label>
                            <label id="reset-time" class="input-group-addon">
                                <span class="glyphicon glyphicon-remove"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <button type="submit" style="padding: 6px 12px;font-size: 13px" class="btn btn-sm btn-success" id="filter_date" data-href="{{route('orders.doanh-thu')}}">Tìm</button>
                </div>
                <table id="table-ajax" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người nhận</th>
                            <th>Mã đơn hàng</th>
                            <th>Số tiền</th>
                            <th>Ngày nhận</th>
                            <th>Note</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
           </div>
        </div>
    </div>
    @section('scripts')
    <script>
        jQuery(document).ready(function ($) {
            $('#table-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('orders.doanh-thu') !!}',
                    type: 'GET',
                    data: function (d) {
                      // read start date from the element
                      d.start_date = $('#startDate').val();
                      // read end date from the element
                      d.end_date = $('#endDate').val();
                      // d.code = $('#code').val();
                    }
                },
                pageLength: 20,
                columns: [
                    {data: 'checkbox', name: 'checkbox'},
                    // {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    {data: 'name_nguoinhan', name: 'name_nguoinhan'},
                    {data: 'mavd', name: 'mavd'},
                    {data: 'money', name: 'money'},
                    {data: 'ngay_nhan', name: 'ngay_nhan'},
                    {data: 'name_status', name: 'name_status'},

                ],
                'columnDefs': [{
                    'targets': [0, 1],
                    'orderable': false,
                    'searchable': false,
                }],
                language: {
                    "sProcessing": "Đang xử lý...",
                    "sLengthMenu": "Xem _MENU_ mục",
                    "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                    "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix": "",
                    "sSearch": "Tìm:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Đầu",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối"
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#reset-time').on('click',function (e) {
            $('#startDate').val('');
            $('#endDate').val('');
        })
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
          // defaultDate: @if(@$stdf) '{{@$stdf}}' @else sd @endif, 
          maxDate: ed 
        });
      
        $('#endDate').datetimepicker({ 
          pickTime: false, 
          format: "DD-MM-YYYY", 
          // defaultDate: @if(@$endf) '{{@$endf}}' @else ed @endif,
          minDate: sd 
        });

        //passing 1.jquery form object, 2.start date dom Id, 3.end date dom Id
        bindDateRangeValidation($("#form"), 'startDate', 'endDate');
    });
    $('#filter_date').on('click',function(){
        var url = $(this).data('href');
        var startdate = $('#startDate').val();
        var enddate = $('#endDate').val();

        window.location.href = url+'?startdate='+startdate+'&enddate='+enddate;
    });
    </script>
    @endsection
@stop