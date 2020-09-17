@extends('backend.layouts.app') 
@section('controller','Tài khoản')
@section('controller_route', route('users.index'))
@section('action','Thêm')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('users.store') }}" method="POST" autocomplete="off">
	           		<div class="col-md-8">
		                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
		                <div class="form-group">
		                    <label>Họ và tên</label>
		                    <input type="text" class="form-control" name="name" 
		                    value="{!! old('name') !!}">
		                </div>
		                <div class="form-group">
		                    <label>Số điện thoại</label>
		                    <input type="text" class="form-control" name="phone" value="{!! old('phone') !!}">
		                </div>
		                <div class="form-group">
		                    <label>Tài khoản</label>
		                    <input type="text" class="form-control" name="user_name" value="{!! old('user_name') !!}">
		                </div>
		                <div class="form-group">
		                    <label>Mật khẩu</label>
		                    <input type="password" class="form-control" name="password" value="">
		                </div>
		                <div class="form-group">
		                    <label>Nhập lại mật khẩu</label>
		                    <input type="password" class="form-control" name="repassword" value="">
		                </div>
		                <div class="form-group">
		                    <label>Email</label>
		                    <input type="text" class="form-control" name="email" value="{!! old('email') !!}">
		                </div>
		                <div class="form-group">
		                    <label>Vai trò</label>
		                    <select name="level" class="form-control">
		                        <option value="1" selected>Người quản lý</option>
		                        <option value="2">Biên tập viên</option>
		                    </select>
		                </div>
		                <div class="form-check">
		                    <input class="form-check-input" type="checkbox" value="1" id="status" 
		                    checked name="status">
		                    <label class="form-check-label" for="status">
		                        Kích hoạt
		                    </label>
		                </div>
		                <div class="form-group">
		                	<button type="submit" class="btn btn-primary">Thêm mới</button>
		                </div>
		            </div>
		            <div class="col-sm-4">
		                <div class="form-group">
	                      	<div class="form-group">
	                           <label>Hình ảnh</label>
	                           <div class="image">
	                               <div class="image__thumbnail">
	                                   <img src="{{ old('image') ? old('image') :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
	                                   <a href="javascript:void(0)" class="image__delete" 
	                                   onclick="urlFileDelete(this)">
	                                    <i class="fa fa-times"></i></a>
	                                   <input type="hidden" value="{{ old('image') }}" name="image"  />
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