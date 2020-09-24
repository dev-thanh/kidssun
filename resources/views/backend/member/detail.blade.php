@extends('backend.layouts.app')
@section('controller', 'Thông tin chi tiết' )
@section('controller_route', route('member.index'))
@section('action', 'Thông tin chi tiết')
@section('content')
	<style type="text/css" media="screen">
		.form-group input{
			padding: 20px 10px;
			background-color: #ececff !important;
		}
        .products-table {
            width: 100%;
        }
        .products-table td, .products-table th {
            padding: 15px;
            text-align: center;
            color: #333;
            vertical-align: middle;
        }
	</style>
	<div class="content">
		<div class="clearfix"></div>
		<div class="box box-primary">
            <div class="box-body">
		       	@include('flash::message')
		       	
					<div class="row">
						<div class="tab-content">
                            
                            <div class="col-sm-12">
                                <div class="header-bank-right">
                                    <h2 style="padding: 15px">
                                        Danh sách đơn hàng
                                    </h2>
                                </div>
                                <table border="1" class="products-table">
                                    <thead style="background: #f26824">
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Tổng tiền</th>
                                            <th>Ngày mua</th>
                                            <th>Trạng thái</th>
                                            <th>Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($orders) > 0)
                                        @foreach($orders as $k => $item)
                                        <tr>
                                            <td>
                                                <span>{{$k+1}}</span>
                                            </td>
                                            <td>
                                                <a href="#" title="Mã đơn">
                                                    <span>{{$item->mavd}}</span>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="product-prices">
                                                    <span class="price">{!! number_format(@$item->tongtien, 0, '.', '.')!!} đ</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span>{{format_datetime($item->created_at,'d-m-Y')}}</span>
                                            </td>
                                            <td class="status">
                                                <span>{{$item->name_status}}</span>
                                            </td>
                                            <td>
                                                <a href="#" class="code-orders show-order-detal" data-id="{{$item->id}}">
                                                    <i class="fa fa-eye fa-fw"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                    		<div class="col-sm-12">
                                <div class="header-bank-right">
                                    <h2 style="padding: 15px">
                                        Danh sách nạp tiền
                                    </h2>
                                </div>
                    			<table id="table1" class="table table-bordered table-striped">
                                    <thead style="background: #c0bcbc">
                                        <tr>
                                            <th>Người gửi</th>
                                            <th>Tên ngân hàng</th>
                                            <th>Số tiền</th>
                                            <th>Mã giao dịch</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(@$recharge as $item)
                                        <tr>
                                            <td>{{$item->sender}}</td>
                                            <td>{{$item->bankname}}</td>
                                            <td>{!! number_format(@$item->amount_money, 0, '.', ',')!!} đ</td>
                                            <td>{{$item->trading_code}}</td>
                                            <td>
                                                @if($item->id_status == 1)
                                                    <span class="label label-primary">Chờ duyệt</span>
                                                @elseif($item->id_status == 2)
                                                    <span class="label label-success">Thành công</span>
                                                @else
                                                    <span class="label label-danger">Đã hủy</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                    		</div>
                    		                   
		                </div>
					</div>
				<!-- </form> -->
			</div>
		</div>
	</div>
    <div class="art-popups art-popups-code-orders">
        <div class="popups-box">
            <div class="popups-content">
                <div class="popup-content active">
                <div class="title-box title-popup">
                    <h3 class="title"><span>{{ trans('message.don_hang') }}</span></h3>
                </div>
                <div class="popup-content">
                    <div class="products-content">
                        <div class="table-content order-detail-content text-center">
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
	<script type="text/javascript">
		$(document).ready(function() {
            $('#table1,#table2').DataTable( {      
                 "searching": false,
                 "paging": true, 
                 "info": false,         
                 "lengthChange":false 
            } );
        });
	</script>
@stop