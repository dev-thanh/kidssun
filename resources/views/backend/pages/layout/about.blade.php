@extends('backend.layouts.app')
@section('controller','Trang')
@section('controller_route',route('pages.list'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('pages.build.post') }}" method="POST">
					{{ csrf_field() }}
					<input name="type" value="{{ $data->type }}" type="hidden">
					<input name="lang" value="{{ $data->lang }}" type="hidden">

	               	<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Trang</label>
								<input type="text" class="form-control" value="{{ $data->name_page }}" disabled="">
				 				
								@if (\Route::has($data->route))
									<h5>
										<a href="{{ route($data->route) }}" target="_blank">
					                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
					                        Link: {{ route($data->route) }}
					                    </a>
									</h5>
				                @endif
							</div>
							
						</div>
					</div>
					<div class="nav-tabs-custom">
				        <ul class="nav nav-tabs">
				        	<li class="active">
				            	<a href="#content-1" data-toggle="tab" aria-expanded="true">Khối 1</a>
							</li>
							<li class="">
				            	<a href="#content-2" data-toggle="tab" aria-expanded="true">Khối 2</a>
							</li>
							<li class="">
				            	<a href="#content-3" data-toggle="tab" aria-expanded="true">Khối 3</a>
							</li>
							<li class="">
				            	<a href="#content-4" data-toggle="tab" aria-expanded="true">Thư viện ảnh</a>
				            </li>
							<li class="">
				            	<a href="#seo" data-toggle="tab" aria-expanded="true">Cấu hình trang</a>
				            </li>
				        </ul>
					</div>
					<?php if(!empty($data->content)){
						$content = json_decode($data->content);
					} ?>
				    <div class="tab-content">
						
						<div class="tab-pane active" id="content-1">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
										<label>Hình ảnh</label>
										<div class="image">
											<div class="image__thumbnail">
												<img src="{{ @$content->content_1->image ?  $content->content_1->image : __IMAGE_DEFAULT__ }}"  
												data-init="{{ __IMAGE_DEFAULT__ }}">
												<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
													<i class="fa fa-times"></i></a>
												<input type="hidden" value="{{ @$content->content_1->image }}" name="content[content_1][image]"  />
												<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Tiêu đề</label>
										<input type="text" class="form-control" name="content[content_1][title]" value="{{ @$content->content_1->title }}">
									</div>
									<div class="form-group">
										<label for="">Nội dung</label>
										<textarea name="content[content_1][content]" class="content">{!! @$content->content_1->content !!}</textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="content-2">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
										<label>Hình ảnh</label>
										<div class="image">
											<div class="image__thumbnail">
												<img src="{{ @$content->content_2->image ?  $content->content_2->image : __IMAGE_DEFAULT__ }}"  
												data-init="{{ __IMAGE_DEFAULT__ }}">
												<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
													<i class="fa fa-times"></i></a>
												<input type="hidden" value="{{ @$content->content_2->image }}" name="content[content_2][image]"  />
												<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Tiêu đề</label>
										<input type="text" class="form-control" name="content[content_2][title]" value="{{ @$content->content_2->title }}">
									</div>
									<div class="form-group">
										<label for="">Nội dung</label>
										<textarea name="content[content_2][content]" class="content">{!! @$content->content_2->content !!}</textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="content-3">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
										<label>Hình ảnh</label>
										<div class="image">
											<div class="image__thumbnail">
												<img src="{{ @$content->content_3->image ?  $content->content_3->image : __IMAGE_DEFAULT__ }}"  
												data-init="{{ __IMAGE_DEFAULT__ }}">
												<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
													<i class="fa fa-times"></i></a>
												<input type="hidden" value="{{ @$content->content_3->image }}" name="content[content_3][image]"  />
												<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Tiêu đề</label>
										<input type="text" class="form-control" name="content[content_3][title]" value="{{ @$content->content_3->title }}">
									</div>
									<div class="form-group">
										<label for="">Nội dung</label>
										<textarea name="content[content_3][content]" class="content">{!! @$content->content_3->content !!}</textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="content-4">
							<div class="form-group image">
								<button type="button" class="btn btn-success" onclick="fileMultiSelectCustom(this, 'content[content_4][gallery]')"><i class="fa fa-upload"></i>  
									Chọn hình ảnh
								</button>
								<br><br>
								<div class="image__gallery">
									@if (!empty($content->content_4->gallery))
										@foreach ($content->content_4->gallery as $item)
											<div class="image__thumbnail image__thumbnail--style-1">
												<img src="{{ $item }}">
												<a href="javascript:void(0)" class="image__delete" onclick="urlFileMultiDelete(this)">
													<i class="fa fa-times"></i>
												</a>
												<input type="hidden" name="content[content_4][gallery][]" value="{{ $item }}">
											</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
						
						<div class="tab-pane" id="seo">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->image ?  $data->image : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->image }}" name="image"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Banner</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->banner ?  $data->banner : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->banner }}" name="banner"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-8">
									<div class="form-group">
										<label for="">Tiêu đề trang</label>
										<input type="text" name="meta_title" class="form-control" value="{{ @$data->meta_title }}">
									</div>
									<div class="form-group">
										<label for="">Mô tả trang</label>
										<textarea name="meta_description" 
										class="form-control" rows="5">{!! @$data->meta_description !!}</textarea>
									</div>
									<div class="form-group">
										<label for="">Từ khóa</label>
										<input type="text" name="meta_keyword" class="form-control" value="{!! @$data->meta_keyword !!}">
									</div>
									<div class="form-group">
										<label for="">Tiêu đề thẻ H1 ẩn</label>
										<input type="text" name="title_h1" class="form-control" value="{!! @$data->title_h1 !!}">
									</div>
								</div>
							</div>
			            </div>
			           <button type="submit" class="btn btn-primary">Lưu lại</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@stop