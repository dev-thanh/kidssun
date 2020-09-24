@extends('backend.layouts.app')
@section('controller','Cấp bậc thành viên')
@section('action','Cập nhập')
@section('controller_route', route('member.rank'))
@section('content')
<style type="text/css" media="screen">
	.deposit{
		display: table;
	}
	.depotit{
		padding: 3px 2px;
    	background: #ccc;
	}
</style>
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
	            <form action="{{route('member.postaddrank')}}" method="POST">
	            	@csrf
	               	<div class="col-sm-8">               		
		           		<table class="table table-bordered table-striped">
		           			<thead>
		           				<tr>
		           					<th>STT</th>
		           					<th class="text-center">Cấp bậc</th>
		           					<th class="text-center">Tổng giá trị giao dịch</th>
		           					<th class="text-center">Đặt cọc</th>
		           				</tr>
		           			</thead>
		           			<tbody>
		           				@for($i = 0; $i < 5; $i++)
		           				<tr>
		           					<td>{{$i+1}}</td>
		           					<td style="font-size: 20px">
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i @if($i==1 || $i==2 || $i==3 || $i==4) style="color: #f39c12" @endif class="fa fa-star"></i>
		           						<i @if($i==2 || $i==3 || $i==4) style="color: #f39c12" @endif class="fa fa-star"></i>
		           						<i @if($i==3 || $i==4) style="color: #f39c12" @endif class="fa fa-star"></i>
		           						<i @if($i==4) style="color: #f39c12" @endif class="fa fa-star"></i>
		           					</td>
		           					<td class="text-center">
		           						<label style="margin-right: 5px">Từ</label>
		           						<input type="number" name="money_from{{$i+1}}" value="{{@$rank[$i]['money_from']}}">
		           						<label for="" style="margin: 0 5px">Đến</label>
		           						<input type="number" name="money_to{{$i+1}}" value="{{@$rank[$i]['money_to']}}">
		           						<input type="hidden" name="id_{{$i+1}}" value="{{@$rank[$i]['id']}}">
		           					</td>
		           					<td class="text-center">		           						
		           						<input type="number" name="deposit{{$i+1}}" value="{{@$rank[$i]['deposit']}}">
		           						<label for="startDate" class="depotit">
					                        %
					                    </label>
		           					</td>
		           				</tr>
		           				@endfor
		           				<!-- <tr>
		           					<td>1</td>
		           					<td style="font-size: 20px">
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i class="fa fa-star"></i>
		           						<i class="fa fa-star"></i>
		           						<i class="fa fa-star"></i>
		           					</td>
		           					<td class="text-center">
		           						<label style="margin-right: 5px">Từ</label>
		           						<input type="number" name="money_from2" value="">
		           						<label for="" style="margin: 0 5px">Đến</label>
		           						<input type="number" name="money_to2" value="">
		           					</td>
		           				</tr>
		           				<tr>
		           					<td>1</td>
		           					<td style="font-size: 20px">
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i class="fa fa-star"></i>
		           						<i class="fa fa-star"></i>
		           					</td>
		           					<td class="text-center">
		           						<label style="margin-right: 5px">Từ</label>
		           						<input type="number" name="money_from3" value="">
		           						<label for="" style="margin: 0 5px">Đến</label>
		           						<input type="number" name="money_to3" value="">
		           					</td>
		           				</tr>
		           				<tr>
		           					<td>1</td>
		           					<td style="font-size: 20px">
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i class="fa fa-star"></i>
		           					</td>
		           					<td class="text-center">
		           						<label style="margin-right: 5px">Từ</label>
		           						<input type="number" name="money_from4" value="">
		           						<label for="" style="margin: 0 5px">Đến</label>
		           						<input type="number" name="money_to4" value="">
		           					</td>
		           				</tr>
		           				<tr>
		           					<td>1</td>
		           					<td style="font-size: 20px">
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           						<i style="color: #f39c12" class="fa fa-star"></i>
		           					</td>
		           					<td class="text-center">
		           						<label style="margin-right: 5px">Từ</label>
		           						<input type="number" name="money_from5" value="">
		           						<label for="" style="margin: 0 5px">Đến</label>
		           						<input type="number" name="money_to5" value="">
		           					</td>
		           				</tr> -->
		           			</tbody>
		           		</table>
	               	</div>
	               	<div class="col-sm-12">	               		
		               	<button class="btn btn-success" type="submit">Lưu lại</button>
	               	</div>
	            </form>
           </div>
        </div>
	</div>
	@section('scripts')
	<script type="text/javascript">
        
    </script>
    @endsection
@stop