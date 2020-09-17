<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<div class="form-group">
			<label for="">Hình ảnh</label>
			<div class="image">
	           	<div class="image__thumbnail">
	               <img src="{{ !empty($value->image) ? $value->image : __IMAGE_DEFAULT__ }}"  
	               data-init="{{ __IMAGE_DEFAULT__ }}">
	               <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
	                <i class="fa fa-times"></i></a>
	               <input type="hidden" value="{{ @$value->image }}" name="content[indicators][list][{{ $key }}][image]"  />
	               <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
	           	</div>
	       	</div>
		</div>
	</td>
	<td>
		<div class="form-group">
			<label for="">Thông số</label>
			<input type="text" name="content[indicators][list][{{ $key }}][number]" class="form-control" value="{{ @$value->number }}">
		</div>
		<div class="form-group">
			<label for="">Mô tả</label>
			<textarea name="content[indicators][list][{{ $key }}][content]" class="form-control">{!! @$value->content !!}</textarea>
		</div>
	</td>
	<td style="text-align: center; display: none;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>