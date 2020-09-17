@extends('backend.layouts.app')
@section('controller','Tài khoản')
@section('controller_route', route('users.index'))
@section('action','Chỉnh sửa')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('users.update', $data->id) }}" method="POST" autocomplete="off">
               		{!! method_field('PUT') !!}
	           		<div class="col-md-8">
		                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
		                <div class="form-group">
		                    <label>Họ và tên</label>
		                    <input type="text" class="form-control" name="name" 
		                    value="{!! old('name', isset($data->name) ? $data->name : null) !!}">
		                </div>
		                <div class="form-group">
		                    <label>Số điện thoại</label>
		                    <input type="text" class="form-control" name="phone" 
		                    value="{!! old('phone', isset($data->phone) ? $data->phone : null) !!}">
		                </div>
		                <div class="form-group">
		                    <label>Tài khoản</label>
		                    <input type="text" class="form-control" name="user_name" 
		                    value="{!! old('user_name', isset($data->user_name) ? $data->user_name : null) !!}" readonly="">
		                </div>
		                <div class="form-group">
		                    <label>Email</label>
		                    <input type="text" class="form-control" name="email" 
		                    value="{!! old('email', isset($data->email) ? $data->email : null) !!}">
		                </div>
		                @if (Auth::user()->user_name != $data->user_name)
		                <div class="form-group">
		                    <label>Vai trò</label>
		                    <select name="level" class="form-control" >
		                        <option value="1" {{ $data->level == 1 ? 'selected' : null }}>Người quản lý</option>
		                        <option value="2" {{ $data->level == 2 ? 'selected' : null }}>Biên tập viên</option>
		                    </select>
		                </div>
		                @endif
		                	<div id="pass" class="hidden">
			                    <div class="form-group">
			                      <label>Mật khẩu</label>
			                      <input type="password" class="form-control" name="password" value="">
			                  </div>
			                <div class="form-group">
			                      <label>Nhập lại mật khẩu</label>
			                      <input type="password" class="form-control" name="repassword" value="">
			                </div>
		                </div>
		                @if (Auth::user()->user_name != $data->user_name)
		                  <div class="form-check">
		                      <input class="form-check-input" type="checkbox" value="1" id="status" 
		                      {{ $data->status == 1 ? 'checked' : null }} name="status">
		                      <label class="form-check-label" for="status">
		                          Kích hoạt
		                      </label>
		                  </div>
		                @endif
		                <div class="form-group">
		                	<button type="submit" class="btn btn-primary">Cập nhật</button>
		                	 <button type="button" id="chanePass" class="btn bg-olive margin">Thay đổi mật khẩu</button>
		                </div>
		            </div>
		            <div class="col-sm-4">
		                <div class="form-group">
	                      	<div class="form-group">
	                           <label>Hình ảnh</label>
	                           <div class="image">
	                               <div class="image__thumbnail">
	                                   <img src="{{ !empty($data->image) ? $data->image :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
	                                   <a href="javascript:void(0)" class="image__delete" 
	                                   onclick="urlFileDelete(this)">
	                                    <i class="fa fa-times"></i></a>
	                                   <input type="hidden" value="{{ $data->image }}" name="image"  />
	                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
	                               </div>
	                           </div>
	                       </div>
		                </div>
		            </div>
	            </form>
           </div>
        </div>
	</div>
@stop
@section('scripts')
	  <script>
	    jQuery(document).ready(function($) {
	      $('#chanePass').click(function(event) {
	        $('#pass').toggleClass('hidden');
	      });
	    });
	  </script>
@endsection