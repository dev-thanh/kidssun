@extends('backend.layouts.app')
@section('controller','Tài khoản')
@section('action','Danh sách')
@section('controller_route', route('users.index'))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
           		<div class="btnAdd">
			      	<a href="{{ route('users.create') }}">
			          	<fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm tài khoản</fa>
			      	</a>
			    </div>

			    <table id="example1" class="table table-bordered table-striped">
			    	<thead>
			    		<tr>
			    			<th>STT</th>
			    			<th>Tên tài khoản</th>
			    			<th>Tên người dùng</th>
			    			<th>Số điện thoại</th>
			    			<th>Email</th>
			    			<th>Trạng thái</th>
			    			<th>Hành động</th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		@foreach ($data as $item)
			    		<tr>
			    			<td>{{ $loop->index +1 }}</td>
			    			<td>
			    				@if (!empty($item->image))
			    					<img src="{{ $item->image }}"  width="35px" height="35px">
			    				@else
			    					<img src="{{ asset('uploads/user/no-image.png') }}">
			    				@endif
			    				&nbsp; &nbsp;
			    				{{ $item->user_name }}
			    			</td>
			    			<td>{{ $item->name }}</td>
			    			<td>{{ $item->phone }}</td>
			    			<td>{{ $item->email }}</td>
			    			<td>
			    				@if ($item->status == 1 )
			    					<span class="label label-success">Đang hoạt động</span>
			    				@else
			    					<span class="label label-danger">Đang khóa</span>
			    				@endif
			    			<td>
		    					@if ($item->user_name != 'gco_admin')
			    					<a href="{{ route('users.edit', $item->id ) }}">
			    						<i class="fa fa-pencil fa-fw"></i> Sửa
			    					</a> &nbsp; &nbsp; &nbsp;
			    					<a href="javascript:;" class="btn-destroy" data-href="{{ route( 'users.destroy',  $item->id ) }}"
			    						data-toggle="modal" data-target="#confim">
			    						<i class="fa fa-trash-o fa-fw"></i> Xóa
			    					</a>
		    					@endif
			    			</td>
			    		</tr>
			    		@endforeach
		    		</tbody>
		    	</table>
           </div>
        </div>
	</div>
@stop