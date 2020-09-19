@extends('backend.layouts.app')
@section('controller', 'Danh mục sản phẩm' )
@section('controller_route', route('category.index'))
@section('action', renderAction(@$module['action']))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
					@csrf
					@if(isUpdate(@$module['action']))
				        {{ method_field('put') }}
				    @endif
				    <div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
		                    <li class="active">
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Danh mục dự án</a>
		                    </li>
		                    <li class="">
		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
		                    </li>
		                </ul>
		                <div class="tab-content">
		                    <div class="tab-pane active" id="activity">
		                    	<div class="form-group">
									<label for="">Danh mục cha</label>
									<select name="parent_id" id="inputSltCate" class="form-control">
						      			<option value="0">- Danh mục cha --</option>
						      			<?php menueditcategoryproduct($categories,0,$str='',old('parent_id'),$data->parent_id); ?>   		
						      		</select>
								</div>
								
								<div class="form-group">
									<label for="">Tên danh mục</label>
									<input type="text" class="form-control" name="name" id="name" value="{{ old('name', @$data->name) }}">
								</div>
								<div class="form-group">
									<label for="">Đường dẫn tĩnh</label>
									<input type="text" class="form-control" name="slug" id="slug" {{ isUpdate(@$module['action']) ? 'id="slug"' : null }} value="{{ old('slug', @$data->slug) }}">
								</div>

								
								
								@if(isUpdate(@$module['action']))
									
									<div class="form-group">
										<label class="custom-checkbox">
		                                    <input type="checkbox" class="category" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null  }}> Hiển thị trên trang chủ
		                                </label>
									</div>
								@else
									<div class="form-group">
										<label class="custom-checkbox">
		                                    <input type="checkbox" class="category" name="status" value="1" checked=""> Hiển thị trên trang chủ
		                                </label>
									</div>

								@endif


		                    </div>
		                    <div class="tab-pane" id="setting">
		                    	<div class="row">
		                    		<div class="col-sm-8">
		                    			 <div class="form-group">
				                            <label>Title SEO</label>
				                            <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', @$data->meta_title) !!}">
				                        </div>

				                        <div class="form-group">
				                            <label>Meta Description</label>
				                            <textarea name="meta_description" id="" class="form-control" rows="5">{!! old('meta_description', @$data->meta_description) !!}</textarea>
				                        </div>

				                        <div class="form-group">
				                            <label>Meta Keyword</label>
				                            <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', @$data->meta_keyword) !!}">
				                        </div>
		                    		</div>
		                    	</div>
		                    </div>
		                    <button type="submit" class="btn btn-primary">Lưu lại</button>
		                </div>
		            </div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('select').on('change', function () {
			if(this.value == '0'){
				$('.phi-san-pham').css('display','block');
			}else{
				$('.phi-san-pham').css('display','none');
			}
		});
	</script>
@stop