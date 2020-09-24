@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', 'Xác nhận')
@section('content')
	<style type="text/css" media="screen">
		.form-group input{
			padding: 20px 10px;
			background-color: #ececff !important;
		}
	</style>
	<div class="content">
		<div class="clearfix"></div>
		<div class="box box-primary">
            <div class="box-body">
		       	@include('flash::message')
		       	<!-- <form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
					@csrf
					@if(isUpdate(@$module['action']))
				        {{ method_field('put') }}
				    @endif -->
					<div class="row">
						<div class="tab-content">
                    		<div class="col-sm-6">
                    			<div class="form-group">
                                    <label>Tên tài khoản thành viên</label>
                                    <input type="text" class="form-control" name="username" value="{{@$data->member_name}}" readonly required="">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ email thành viên</label>
                                    <input type="text" class="form-control" name="username" value="{{@$data->member_email}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại đăng ký thành viên</label>
                                    <input type="text" class="form-control" name="username" value="{{@$data->member_phone}}" readonly>
                                </div>
                    			<div class="form-group">
                                    <label>Tên người chuyển</label>
                                    <input type="text" class="form-control" name="sender" id="name" value="{!! old('sender', @$data->sender) !!}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tên ngân hàng chuyển</label>
                                    <input type="text" class="form-control" name="bankname" id="bankname" value="{!! old('bankname', @$data->bankname) !!}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Số tiền chuyển</label>
                                    <div style="display: table">                                    	
	                                    <input type="text" class="form-control" @if(@$data->status == 2) readonly @endif id="amount_money" value="{!! number_format(@$data->amount_money, 0, '.', ',')!!}" required="">
	                                    <label class="input-group-addon" for="endDate">
					                        <span class="">đ</span>
					                    </label>
                                    </div>
                                    <input type="hidden" name="amount_money" @if(@$data->status == 2) readonly @endif value="{{@$data->amount_money}}">
                                    @if(@$data->status !=2)
                                    <!-- <span style="float: right;color: #a44848">Có thể nhập số tiền nếu số tiền nhận được không đúng</span> -->
                                    @endif
                                </div>
                                @if(@$data->id_status == 1)
                                    <div style="display: flex;margin-top: 25px">
                                        <a onclick="return confirm('Bạn có chắc chắn đã nhận được tiền ?')" href="{{route('recharge.xac-nhan',['id_status'=>2,'id'=>@$data->member_id,'money'=>@$data->amount_money,'id_recharge'=>@$data->id])}}" title="Xác nhận đã nhận được tiền">                                       
                                            <button class="btn btn-success" style="margin-right: 25px" type="">Xác nhận đã nhận được tiền</button>
                                        </a>
                                        <a onclick="return confirm('Bạn có chắc chắn hủy bỏ ?')" href="{{route('recharge.xac-nhan',['id_status'=>3,'id_recharge'=>@$data->id])}}" title="Chưa nhận được tiền">
                                            <button style="margin-right: 25px" class="btn btn-danger" type="">Hủy bỏ</button>
                                        </a>
                                        <a href="{{route('recharge.index')}}" title="Chưa nhận được tiền">
                                            <button class="btn btn-info" type="">Đang chờ chuyển</button>
                                        </a>
                                    </div>
                                @elseif(@$data->id_status == 2)
                                    <label for="">Trạng thái:</label>
                                    <span class="label label-success">
                                        Thành công
                                    </span>
                                @else
                                <div style="display: flex;margin-top: 25px">
                                    <label for="">Trạng thái:</label>
                                	<span class="label label-danger">
                                        Đã hủy
                                    </span>
                                </div>
                                @endif
                    		</div>
                    		<div class="col-sm-6">
                    			<label>Hình ảnh bil chuyển tiền</label>
                            	<div>                               		
                               		<img src="{{url('/')}}/public/images/naptien/{{@$data->member_id}}_{{@$data->image}}" alt="Bil chuyển tiền">
                            	</div>
                    		</div>	                    
		                </div>
					</div>
				<!-- </form> -->
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('input#amount_money').keyup(function(event) {

		  // skip for arrow keys
		  if(event.which >= 37 && event.which <= 40) return;

		  // format number
		  $(this).val(function(index, value) {
		    return value
		    .replace(/\D/g, "")
		    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		    ;
		  });
		  var number = $(this).val().replace(/,/g, '');
		  $('input[name="amount_money"]').val(number);
		});
	</script>
@stop