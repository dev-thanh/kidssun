@extends('backend.layouts.app')
@section('controller','Cấu hình chung')
@section('action','Cập nhật')
@section('controller_route', route('backend.options.general'))
@section('content')
	<div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('backend.options.general.post') }}" method="POST">
               		@csrf
               		 <div class="nav-tabs-custom">
			            <ul class="nav nav-tabs">
			               <li class="active">
								   <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a>
							</li>
			                <li class="">
			                	<a href="#activity1" data-toggle="tab" aria-expanded="true">Thông tin liên hệ</a>
							</li>
							<li class="">
								<a href="#activity2" data-toggle="tab" aria-expanded="true">Sidebar các trang</a>
						 	</li>
			               	<li class="">
			               		<a href="#activity3" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
							</li>
			            </ul>
				        <div class="tab-content">

	                		<div class="tab-pane active" id="activity">
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

				                    <div class="col-lg-2">
				                        <div class="form-group">
				                           <label>Hình ảnh đại diện khi chia sẻ</label>
				                           <div class="image">
				                               <div class="image__thumbnail">
				                                   <img src="{{ !empty($content->logo_share) ? $content->logo_share :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
				                                   <a href="javascript:void(0)" class="image__delete" 
				                                   onclick="urlFileDelete(this)">
				                                    <i class="fa fa-times"></i></a>
				                                   <input type="hidden" value="{{ @$content->logo_share }}" name="content[logo_share]"  />
				                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
				                               </div>
				                           </div>
				                       </div>
				                    </div>
			               		</div>

			               		<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label for="">Code Google Maps</label>
											<textarea name="content[google_maps]" class="form-control" rows="10">{!! @$content->google_maps !!}</textarea>
										</div>
								 	</div>
			               			<div class="col-sm-3">
			               				<div class="form-group">
			               					<label for="">Code Google Analytics</label>
			               					<textarea name="content[google_analytics]" class="form-control" rows="10">{!! @$content->google_analytics !!}</textarea>
			               				</div>
			               			</div>
			               			<div class="col-sm-3">
			               				<div class="form-group">
			               					<label for="">Script</label>
			               					<textarea name="content[script]" class="form-control" rows="10">{!! @$content->script !!}</textarea>
			               				</div>
			               			</div>
			               		</div>

			               		<div class="row">
			               			<div class="col-sm-12">
			               				<div class="form-group">
				               				<label for="">Email nhận thông tin liên hệ</label>
				               				<input type="email" class="form-control" name="content[email_admin]" value="{{ @$content->email_admin }}">
										</div>
				               			<div class="form-group">
			                                <label class="custom-checkbox">
			                                    <input type="checkbox" name="content[index_google]" value="1" {{ @$content->index_google == 1 ? 'checked' : null }}> 
			                                    Cho phép google tìm kiếm
			                                </label>
			                            </div>

		                            </div>
			               			
			               		</div>
			               	</div>

			               	<div class="tab-pane" id="activity1">
			               		<div class="row">
			               			<div class="col-sm-6">
										<div class="form-group">
											<label for="">Tên công ty tiếng việt</label>
											<input type="text" name="content[name_company]" class="form-control" value="{{ @$content->name_company }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Tên công ty tiếng anh</label>
											<input type="text" name="content[name_company_en]" class="form-control" value="{{ @$content->name_company_en }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Địa chỉ tiếng việt</label>
											<input type="text" name="content[address]" class="form-control" value="{{ @$content->address }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Địa chỉ tiếng anh</label>
											<input type="text" name="content[address_en]" class="form-control" value="{{ @$content->address_en }}">
										</div>
									</div>
						            <div class="col-sm-12">
										<div class="form-group">
											<label for="">Email</label>
											<input type="text" name="content[email]" class="form-control" value="{{ @$content->email }}">
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="">Hotline 1</label>
													<input type="text" name="content[hotline]" class="form-control" value="{{ @$content->hotline }}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="">Hotline 2</label>
													<input type="text" name="content[hotline2]" class="form-control" value="{{ @$content->hotline2 }}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="">Facebook</label>
													<input type="text" name="content[link_facebook]" class="form-control" value="{{ @$content->link_facebook }}">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="">Youtube</label>
													<input type="text" name="content[link_youtube]" class="form-control" value="{{ @$content->link_youtube }}">
												</div>
											</div>
										</div>
										<div class="form-group">
						            		<label for="">Mail</label> 
						            		<input type="text" class="form-control" name="content[link_mail]" 
						            		value="{{ @$content->link_mail }}">
						            	</div>
						            	<div class="form-group">
						            		<label for="">Bản quyền chân trang</label>
						            		<input type="text" class="form-control" name="content[copyright]" 
						            		value="{{ @$content->copyright }}">
						            	</div>
						            </div>
			               		</div>
							</div>

							<div class="tab-pane" id="activity2">
								<div class="row">
									<div class="col-sm-6">
										<h4 class="text-uppercase">Banner side bar trang chi tiết tin tức</h4>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label>Banner 1</label>
													<div class="image">
														<div class="image__thumbnail">
															<img src="{{ !empty($content->side_bar->news->banner_1) ? $content->side_bar->news->banner_1 :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
															<a href="javascript:void(0)" class="image__delete" 
															onclick="urlFileDelete(this)">
																<i class="fa fa-times"></i></a>
															<input type="hidden" value="{{ @$content->side_bar->news->banner_1 }}" 
															name="content[side_bar][news][banner_1]"  />
															<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="">Tiêu đề</label>
													<input type="text" name="content[side_bar][news][title_1]" class="form-control" value="{{ @$content->side_bar->news->title_1 }}">
												</div>

												<div class="form-group">
													<label for="">Liên kết</label>
													<input type="text" name="content[side_bar][news][link_1]" class="form-control" value="{{ @$content->side_bar->news->link_1 }}">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label>Banner 2</label>
													<div class="image">
														<div class="image__thumbnail">
															<img src="{{ !empty($content->side_bar->news->banner_2) ? $content->side_bar->news->banner_2 :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
															<a href="javascript:void(0)" class="image__delete" 
															onclick="urlFileDelete(this)">
																<i class="fa fa-times"></i></a>
															<input type="hidden" value="{{ @$content->side_bar->news->banner_2 }}" 
															name="content[side_bar][news][banner_2]"  />
															<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="">Tiêu đề</label>
													<input type="text" name="content[side_bar][news][title_2]" class="form-control" value="{{ @$content->side_bar->news->title_2 }}">
												</div>
												<div class="form-group">
													<label for="">Liên kết</label>
													<input type="text" name="content[side_bar][news][link_2]" class="form-control" value="{{ @$content->side_bar->news->link_2 }}">
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<h4 class="text-uppercase">Banner side bar trang chi tiết video</h4>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label>Banner</label>
													<div class="image">
														<div class="image__thumbnail">
															<img src="{{ !empty($content->side_bar->video->banner) ? $content->side_bar->video->banner :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
															<a href="javascript:void(0)" class="image__delete" 
															onclick="urlFileDelete(this)">
																<i class="fa fa-times"></i></a>
															<input type="hidden" value="{{ @$content->side_bar->video->banner }}" 
															name="content[side_bar][video][banner]"  />
															<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="">Tiêu đề</label>
													<input type="text" name="content[side_bar][video][title]" class="form-control" value="{{ @$content->side_bar->video->title }}">
												</div>

												<div class="form-group">
													<label for="">Liên kết</label>
													<input type="text" name="content[side_bar][video][link]" class="form-control" value="{{ @$content->side_bar->video->link }}">
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>

			               	<div class="tab-pane" id="activity3">
			               		<div class="row">
			               			<div class="col-sm-12">
			               				<div class="form-group">
											<label for="">Tên website</label>
											<input type="text" class="form-control" name="content[site_title]"
											value="{{ @$content->site_title }}">
										</div>

			               				<div class="form-group">
		               						<label for="">Mô tả ngắn</label>
		               						<textarea class="form-control" rows="5" 
		               						name="content[site_description]">{{ @$content->site_description }}</textarea>
			               				</div>

			               				<div class="form-group">
		               						<label for="">Meta keyword</label>
		               						<input type="text" class="form-control" name="content[site_keyword]"
		               						value="{{ @$content->site_keyword }}">
			               				</div>

			               			</div>
			               		</div>
							</div> 
			            </div>
			        </div>
               		<div class="row">
               			<div class="col-lg-12">
               				<button class="btn btn-primary" type="submit">Lưu lại</button>
               			</div>
               		</div>
               	</form>
            </div>
        </div>
    </div>
@stop