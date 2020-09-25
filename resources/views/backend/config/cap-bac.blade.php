@extends('backend.layouts.app')
@section('controller','Cấp bậc đại lý')
@section('action','Danh sách')
@section('controller_route', route('config.index'))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<div class="btnAdd">
                    <a href="{{ route('config.create') }}">
                        <fa class="btn btn-primary"><i class="fa fa-plus"></i> Sửa</fa>
                    </a>
				</div>
               	<div class="col-sm-8">               		
	           		<table class="table table-bordered table-striped">
	           			<thead>
	           				<tr>
	           					<th>STT</th>
	           					<th>Cấp bậc</th>
	           					<th>Tổng giá trị đơn hàng</th>
	           				</tr>
	           			</thead>
	           			<tbody>
	           				@foreach(@$data as $i => $item)
	           				<tr>
	           					<td>{{$i+1}}</td>
	           					<td>
	           						{{$item->name}}
	           					</td>
	           					<td>{!! number_format(@$item->total, 0, '.', '.')!!} đ</td>
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