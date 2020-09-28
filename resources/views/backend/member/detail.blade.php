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
                                        Thông tin chi tiết tài khoản
                                    </h2>
                                </div>
                                <div>
                                    <div>
                                        <div class="col-sm-6 form-group">
                                            <label for="">Trạng thái</label></br>
                                            <span class="label label-success">@if(@$member->lock ==0) Đang hoạt động @else Bị khóa @endif</span>
                                        </div>
                                        <div class="col-sm-6" style="margin-bottom: 10px">
                                            <label for="">Link giới thiệu</label>
                                            <div class="text-center" style="position: relative">                                        
                                                <span id="divClipboard-page" style="color: #ff00eb" class="form-control" name="" >{{url('/')}}?ma-gioi-thieu={{@$member->link_aff}}</span>
                                                <label style="position: absolute;top: 0px;right: 0px;background: #716c72;padding: 7px;cursor: pointer;color: #ffffff;" for="startDate" class="depotit">
                                                    <a href="" title="Copy" class="btn-copy" onclick="copyClipboard_Code('divClipboard-page')">Copy</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Cấp bậc đại lý</label>
                                        <input readonly value="@if(@$member->code =='DLBL') Đại lý bán lẻ @elseif(@$member->code =='DLPP') Đại lý phân phối @else Cộng tác viên @endif" class="form-control">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Mã tài khoản</label>
                                        <input value="{{@$member->link_aff}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Họ tên</label>
                                        <input value="{{@$member->full_name}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Email</label>
                                        <input value="{{@$member->email}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Số điện thoại</label>
                                        <input value="{{@$member->phone}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Địa chỉ</label>
                                        <input value="{{@$member->address}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <?php $gt = App\Models\Member::where('id',$member->id)->first(); ?>
                                        <label for="">Người giới thiệu mở tài khoản</label>
                                        <input value="{{@$gt->full_name}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Số tài khoản ngân hàng</label>
                                        <input value="{{@$member->bank_account}}" class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Tên chủ tài khoản</label>
                                        <input value="{{@$member->bank_account_name}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Ngân hàng</label>
                                        <input value="{{@$member->bank_name}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Địa chỉ ngân hàng</label>
                                        <input value="{{@$member->bank_address}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="">Số chứng minh nhân dân(thẻ căn cước)</label>
                                        <input value="{{@$member->so_cmnd}}" readonly class="form-control" name="">
                                    </div>
                                    <div class="col-sm-6 ">
                                        <label for="">Ảnh chứng minh thư(thẻ căn cước) mặt trước</label>
                                        <div>
                                            @if(@$member->cmnd1 !='')
                                            <img style="max-width: 400px;max-height: 300px" src="{{url('/')}}/public/images/{{@$member->id}}_{{@$member->cmnd1}}" alt="">
                                            @else
                                            <img src="{{url('/')}}/public/images/img-bill.png" alt="">
                                            </br>
                                            <span class="label label-danger">Chưa cập nhập</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <label for="">Ảnh chứng minh thư(thẻ căn cước) mặt sau</label>
                                        <div>
                                            @if(@$member->cmnd2 !='')
                                            <img style="max-width: 400px;max-height: 300px" src="{{url('/')}}/public/images/{{@$member->id}}_{{@$member->cmnd2}}" alt="">
                                            @else
                                            <img src="{{url('/')}}/public/images/img-bill.png" alt="">
                                            </br>
                                            <span class="label label-danger">Chưa cập nhập</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-top: 30px">
                                    @if($member->xac_nhan == 0)
                                    <a href="{{route('member.xac-nhan',['id'=>$member->id])}}" title="">
                                        <button type="button" class="btn btn-primary">Xác nhận tài khoản</button>
                                    </a>
                                    <a href="{{route('member.index')}}" title="">
                                        <button type="button" class="btn btn-danger">Hủy</button>
                                    </a>
                                    @else
                                    <span style="padding: 5px;font-size: 13px" class="label label-success">Tài khoản đã được xác nhận</span>
                                    @endif
                                </div>
                            </div>
                            
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
        function copyClipboard_Code($id) {
            event.preventDefault();
            console.log(222);
            var elm = document.getElementById($id);
            $('.btn-copy').html('Copied');
            setTimeout(function(){
             $('.btn-copy').html('Copy'); },
            1000);
            if(window.getSelection) {
                var selection = window.getSelection();
                var range = document.createRange();
                range.selectNodeContents(elm);
                selection.removeAllRanges();
                selection.addRange(range);
                document.execCommand("Copy");               
            }
        }
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