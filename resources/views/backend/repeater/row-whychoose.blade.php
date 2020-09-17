<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
       <div class="image">
           <div class="image__thumbnail">
               <img src="{{ !empty(@$value->icon) ? @$value->icon :  __IMAGE_DEFAULT__ }}"  
               data-init="{{ __IMAGE_DEFAULT__ }}">
               <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                <i class="fa fa-times"></i></a>
               <input type="hidden" value="{{ @$value->icon }}" name="content[whychoose][list][{{ $id }}][icon]"  />
               <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
           </div>
       </div>
    </td>
	<td>
        <div class="form-group">
            <label for="">Tiêu đề</label>
            <input type="text" class="form-control" name="content[whychoose][list][{{$id}}][title]" value="{{ @$value->title }}">
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea rows="6" class="form-control" name="content[whychoose][list][{{$id}}][content]">{{ @$value->content }}</textarea>
        </div>
    </td>
    <td style="text-align: center; display: none;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>