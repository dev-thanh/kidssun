@extends('backend.layouts.app')
@section('controller','Developer')
@section('action','Upadte')
@section('controller_route', route('backend.options.developer-config'))
@section('content')
	<div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('backend.options.developer-config.post') }}" method="POST">
               		@csrf
               		<div class="row">
               			<div class="col-lg-2">
	                        <div class="form-group">
	                           <label>Favicon</label>
	                           <div class="image">
	                               <div class="image__thumbnail">
	                                   <img src="{{ !empty($content->favicon) ? $content->favicon :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
	                                   <a href="javascript:void(0)" class="image__delete" 
	                                   onclick="urlFileDelete(this)">
	                                    <i class="fa fa-times"></i></a>
	                                   <input type="hidden" value="{{ @$content->favicon }}" name="content[favicon]"  />
	                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
	                               </div>
	                           </div>
	                       </div>
	                    </div>
	                    <div class="col-lg-2">
	                        <div class="form-group">
	                           <label>Logo</label>
	                           <div class="image">
	                               <div class="image__thumbnail">
	                                   <img src="{{ !empty($content->logo) ? $content->logo :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
	                                   <a href="javascript:void(0)" class="image__delete" 
	                                   onclick="urlFileDelete(this)">
	                                    <i class="fa fa-times"></i></a>
	                                   <input type="hidden" value="{{ @$content->logo }}" name="content[logo]"  />
	                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
	                               </div>
	                           </div>
	                       </div>
	                    </div>

	                    <div class="col-sm-8">
	                    	<div class="form-group">
	                    		<label for="">Tiêu đề trang quản trị</label>
	                    		<input type="text" name="content[title]" required="" class="form-control" 
	                    		value="{{ @$content->title }}">
	                    	</div>
	                    	<div class="form-group">
	                    		<label for="">Tiêu đề trang đăng nhập</label>
	                    		<input type="text" name="content[title_login]" required="" class="form-control"
	                    		value="{{ @$content->title_login }}">
	                    	</div>
	                    </div>
               		</div>
               		<button type="submit" class="btn btn-primary">Lưu lại</button>	
               	</form>
            </div>
        </div>
    </div>
@stop