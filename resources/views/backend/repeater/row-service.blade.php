<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<div class="form-group">
			<label for="">Icon</label>
			<div class="image">
	           	<div class="image__thumbnail">
	               <img src="{{ !empty($value->icon) ? $value->icon : __IMAGE_DEFAULT__ }}"  
	               data-init="{{ __IMAGE_DEFAULT__ }}">
	               <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
	                <i class="fa fa-times"></i></a>
	               <input type="hidden" value="{{ @$value->icon }}" name="content[service][list][{{ $key }}][icon]"  />
	               <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
	           	</div>
	       	</div>
		</div>
	</td>
	<td>
		<div class="form-group">
			<label for="">Tiêu đề</label>
			<input type="text" name="content[service][list][{{ $key }}][title]" class="form-control" value="{{ @$value->title }}">
		</div>
	</td>
</tr>