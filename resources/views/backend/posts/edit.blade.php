@extends('backend.layouts.app')
@section('controller', renderLinkAddPostType()['title'])
@section('controller_route', renderLinkAddPostType()['linkList'] )
@section('action','Chỉnh sửa')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
		@include('flash::message')
		<form action="{{ route('posts.update', $data->id) }}" method="POST">
			@csrf
			@method('PUT')
			<input type="hidden" value="blog" name="type">
			<div class="row">
				<div class="col-sm-9">
		            <div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
		                    <li class="active">
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Bài viết tiếng việt</a>
							</li>
							<li class="">
		                        <a href="#activity1" data-toggle="tab" aria-expanded="true">Bài viết tiếng anh</a>
							</li>
							<li class="">
		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
		                    </li>
		                </ul>
		                <div class="tab-content">
		                    <div class="tab-pane active" id="activity">
		                        <div class="row">
		                            <div class="col-sm-12">
		                                <div class="form-group">
		                                    <label>Tên bài viết</label>
		                                    <input type="text" class="form-control" name="name" id="name" value="{!! old('name', @$data->name) !!}">
		                                </div>
		                                <div class="form-group" id="edit-slug-box">
		                                    @include('backend.posts.permalink')
		                                </div>
		                                
		                                <div class="form-group">
		                                    <label>Mô tả ngắn</label>
		                                    <textarea class="form-control" rows="5" name="desc">{!! old('desc', @$data->desc) !!}</textarea>
		                                </div>
		                                
		                                <div class="form-group">
		                                    <label>Nội dung</label>
		                                    <textarea class="content" name="content">{!! old('content', @$data->content) !!}</textarea>
		                                </div>
		                            </div>
		                        </div>
							</div>
							<div class="tab-pane" id="activity1">
		                        <div class="row">
		                            <div class="col-sm-12">
		                                <div class="form-group">
		                                    <label>Tên bài viết</label>
		                                    <input type="text" class="form-control" name="name_en" id="name_en" value="{!! old('name_en', @$data->name_en) !!}">
		                                </div>
		                                <div class="form-group" id="edit-slug-box">
		                                    @include('backend.posts.permalink')
		                                </div>
		                                
		                                <div class="form-group">
		                                    <label>Mô tả ngắn</label>
		                                    <textarea class="form-control" rows="5" name="desc_en">{!! old('desc_en', @$data->desc_en) !!}</textarea>
		                                </div>
		                                
		                                <div class="form-group">
		                                    <label>Nội dung</label>
		                                    <textarea class="content" name="content_en">{!! old('content_en', @$data->content_en) !!}</textarea>
		                                </div>
		                            </div>
		                        </div>
							</div>
							<div class="tab-pane" id="setting">
		                    	<div class="form-group">
			                        <label>Title SEO</label>
			                        <label style="float: right;">Số ký tự đã dùng: <span id="countTitle">{{ @$data->meta_title != null ? mb_strlen( $data->meta_title, 'UTF-8') : 0 }}/70</span></label>
			                        <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', isset($data->meta_title) ? $data->meta_title : null) !!}" id="meta_title">
			                    </div>

			                    <div class="form-group">
			                        <label>Meta Description</label>
			                        <label style="float: right;">Số ký tự đã dùng: <span id="countMeta">{{ @$data->meta_description != null ? mb_strlen( $data->meta_description, 'UTF-8') : 0 }}/360</span></label>
			                        <textarea name="meta_description" class="form-control" id="meta_description" rows="3">{!! old('meta_description', isset($data->meta_description) ? $data->meta_description : null) !!}</textarea>
			                    </div>

			                    <div class="form-group">
			                        <label>Meta Keyword</label>
			                        <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', isset($data->meta_keyword) ? $data->meta_keyword : null) !!}">
			                    </div>
								<h4 class="ui-heading">Xem trước kết quả tìm kiếm</h4>
								<div class="google-preview">
									<span class="google__title"><span>{!! !empty($data->meta_title) ? $data->meta_title : @$data->name !!}</span></span>
									<div class="google__url">
										{{ asset( 'tin-tuc/'.$data->slug ) }}
									</div>
									<div class="google__description">{!! old('meta_description', isset($data->meta_description) ? @$data->meta_description : '') !!}</div>
								</div>
		                    </div>
		                </div>
		            </div>
				</div>
				<div class="col-sm-3">
					<div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Đăng bài viết</h3>
		                </div>
		                <div class="box-body">
		                    <div class="form-group">
		                        <label class="custom-checkbox">
		                            <input type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> Hiển thị
		                        </label>
		                        
	                            <label class="custom-checkbox">
	                                <input type="checkbox" name="hot" value="1" {{ @$data->hot == 1 ? 'checked' : null }}> Nổi bật
								</label>
								
								<label class="custom-checkbox">
	                                <input type="checkbox" name="is_new" value="1" {{ @$data->is_new == 1 ? 'checked' : null }}> Mới nhất
	                            </label>
		                    </div>
		                    <div class="form-group text-right">
		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại bài viết</button>
		                    </div>
		                </div>
					</div>
		            <div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Ảnh đại diện</h3>
		                </div>
		                <div class="box-body">
		                    <div class="form-group" style="text-align: center;">
		                        <div class="image">
		                            <div class="image__thumbnail">
		                                <img src="{{ !empty($data->image) ? $data->image : __IMAGE_DEFAULT__ }}"
		                                     data-init="{{ __IMAGE_DEFAULT__ }}">
		                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
		                                    <i class="fa fa-times"></i></a>
		                                <input type="hidden" value="{{ old('image', @$data->image) }}" name="image"/>
		                                <div class="image__button" onclick="fileSelect(this)">
		                                	<i class="fa fa-upload"></i>
		                                    Upload
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
				</div>
			</div>
		</form>
	</div>
@stop
@section('scripts')
	<script>
		jQuery(document).ready(function($) {
			$('#btn-ok').click(function(event) {
		        var slug_new = $('#new-post-slug').val();
		        var name = $('#name').val();
		        $.ajax({
		        	url: '{{ route('posts.get-slug') }}',
		        	type: 'GET',
		        	data: {
		        		id: $('#idPost').val(),
		        		slug : slug_new.length > 0 ? slug_new : name,
		        	},
		        })
		        .done(function(data) {
		        	$('#change_slug').show();
			        $('#btn-ok').hide();
			        $('.cancel.button-link').hide();
			        $('#current-slug').val(data);
		        	cancelInput(data);
		        })
		    });
		});	
	</script>
@endsection

