@extends('backend.layouts.app')
@section('controller','Cấp bậc đại lý')
@section('action','Cập nhập')
@section('controller_route', route('member.rank'))
@section('content')
<style type="text/css" media="screen">
	.deposit{
		display: table;
	}
	.depotit{
		padding: 3px 5px;
    	background: #ccc;
	}
</style>
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
	            <form action="{{route('config.store')}}" method="POST">
	            	@csrf
	               	<div class="col-sm-8">               		
		           		<table class="table table-bordered table-striped">
		           			<thead>
		           				<tr>
		           					<th>STT</th>
		           					<th class="text-center">Cấp bậc đại lý</th>
		           					<th class="text-center">Tổng giá trị đơn hàng thành công</th>
		           				</tr>
		           			</thead>
		           			<tbody>
		           				@for($i = 0; $i < 2; $i++)
		           				<tr>
		           					<td>{{$i+1}}</td>
		           					<td style="font-size: 20px">
		           						<input type="text" name="name{{$i+1}}" value="{{@$rank[$i]['name']}}">
		           					</td>
		           					<td class="text-center">
		           						
		           						<input id="amount_money{{$i+1}}" type="text" value="{!! number_format(@$rank[$i]['total'], 0, '.', ',')!!}">
		           						<label for="startDate" class="depotit">
					                        đ
					                    </label>
		           						<input type="hidden" name="total{{$i+1}}" value="{{@$rank[$i]['total']}}">
		           					</td>
		           					
		           				</tr>
           						<input type="hidden" name="id_{{$i+1}}" value="{{@$rank[$i]['id']}}">
		           				@endfor
		           				
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