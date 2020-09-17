@extends('backend.layouts.app')
@section('controller','Đơn ứng tuyển')
@section('controller_route',route('get.list.job'))
@section('action','Chi tiết')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        
        @include('flash::message')
		<form action="{{ route('post.edit.job', $data->id) }}" method='POST' enctype="multipart/form-data" name="frmEditProduct">
	        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

	        <div class="nav-tabs-custom">
	            <ul class="nav nav-tabs">
	                <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin</a></li>
	            </ul>

	            <div class="tab-content">
	                <div class="tab-pane active" id="activity">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="">Họ tên</label>
									<input type="text" value="{{ $data->name }}" readonly="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Số điện thoại</label>
									<input type="text" value="{{ $data->phone }}" readonly="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Email</label>
									<input type="text" value="{{ $data->email }}" readonly="" class="form-control">
								</div>

								<div class="form-group">
									<label for="">CV: 
										@if (!empty($data->cv))
											<a href="{{ url($data->cv) }}" target="_blank">{{ url($data->cv) }}</a>
										@endif
									</label>
								</div>
							</div>
							<?php $job = \App\Models\Recruitment::find($data->id_recruitment); ?>
							@if (!empty($job))
								<div class="col-sm-6">
									<div class="form-group">
										<label for="">Công việc ứng tuyển</label>
										<input type="text" value="{{ $job->name }}" readonly="" class="form-control">
									</div>
									<div class="form-group">
										Liên kết: <a href="{{ route('home.single-recruitment', $job->slug) }}" target="_blank">{{ route('home.single-recruitment', $job->slug) }}</a>
									</div>								
								</div>
							@endif
						</div>
	                </div>
	                <div class="form-group">
	                	<label for="1">
	                		<input type="checkbox" id="1" value="1" name="status" {{ $data->status == 1 ? 'checked' : null }}> Đã xử lý
	                	</label>
	                	
	                </div>
	                <button type="submit" class="btn btn-primary">Lưu lại</button>
	            </div>
	        </div>
	    </form>

	</div>
@stop