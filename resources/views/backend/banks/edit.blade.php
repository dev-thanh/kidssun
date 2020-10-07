@extends('backend.layouts.app')
@section('controller', 'Tài khoản ngân hàng' )
@section('controller_route', route('banks.index'))
@section('action', 'Cập nhập')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{route('banks.update',['id'=>@$data->id])}}" method="POST">
					@csrf
					{{ method_field('put') }}
				    <div class="nav-tabs-custom">
		                <!-- <ul class="nav nav-tabs">
		                    <li class="active">
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Danh mục thực đơn</a>
		                    </li>
		                </ul> -->
		                <div class="tab-content">
		                    <div class="tab-pane active" id="activity">
								<div class="form-group">
									<label for="">Tên ngân hàng</label>
									<input type="text" class="form-control" name="name_bank" id="name" value="{{ old('name_bank', @$data->name_bank) }}">
								</div>
								<div class="form-group">
									<label for="">Tên chủ tài khoản</label>
									<input type="text" class="form-control" name="name_account" value="{{ old('name_account', @$data->name_account) }}">
								</div>
								<div class="form-group">
									<label for="">Số tài khoản</label>
									<input type="text" class="form-control" name="number" value="{{ old('number', @$data->number) }}">
								</div>
								<div class="form-group">
									<label for="">Chi nhánh</label>
									<input type="text" class="form-control" name="branch" value="{{ old('branch', @$data->branch) }}">
								</div>

									
								<div class="form-group">
									<label class="custom-checkbox">
										<input type="checkbox" class="category" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null  }}>
										Hiển thị trang chủ
	                                </label>
								</div>								

		                    </div>
		                    <button type="submit" class="btn btn-primary">Lưu lại</button>
		                </div>
		            </div>
				</form>
			</div>
		</div>
	</div>
@stop