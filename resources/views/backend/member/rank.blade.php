@extends('backend.layouts.app')
@section('controller','Cấp bậc thành viên')
@section('action','Danh sách')
@section('controller_route', route('member.rank'))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<div class="btnAdd">
                    <a href="{{ route('member.addrank') }}">
                        <fa class="btn btn-primary"><i class="fa fa-plus"></i> Sửa</fa>
                    </a>
				</div>
               	<div class="col-sm-8">               		
	           		<table class="table table-bordered table-striped">
	           			<thead>
	           				<tr>
	           					<th>STT</th>
	           					<th>Cấp bậc</th>
	           					<th>Tổng giá trị giao dịch</th>
	           					<th>Đặt cọc</th>
	           				</tr>
	           			</thead>
	           			<tbody>
	           				@foreach(@$rank as $i => $item)
	           				<tr>
	           					<td>{{$i+1}}</td>
	           					<td>
	           						<i style="color: #f39c12" class="fa fa-star"></i>
	           						<i @if($i==1 || $i==2 || $i==3 || $i==4) style="color: #f39c12" @endif class="fa fa-star"></i>
	           						<i @if($i==2 || $i==3 || $i==4) style="color: #f39c12" @endif class="fa fa-star"></i>
	           						<i @if($i==3 || $i==4) style="color: #f39c12" @endif class="fa fa-star"></i>
	           						<i @if($i==4) style="color: #f39c12" @endif class="fa fa-star"></i>
	           					</td>
	           					<td>{{$item->money_from}} đ - {{$item->money_to}} đ</td>
	           					<td>{{$item->deposit}}%</td>
	           				</tr>
	           				@endforeach
	           			</tbody>
	           		</table>
               	</div>
           </div>
        </div>
	</div>
	@section('scripts')
	<script type="text/javascript">
        
    </script>
    @endsection
@stop