<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
       <div class="image">
           <div class="image__thumbnail">
               <img src="{{ __IMAGE_DEFAULT__ }}"  
               data-init="{{ __IMAGE_DEFAULT__ }}">
               <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                <i class="fa fa-times"></i></a>
               <input type="hidden" value="" name="content[criteria][{{ $key }}][background]"  />
               <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
           </div>
       </div>
	</td>
	<td>
       <div class="image">
           <div class="image__thumbnail">
               <img src="{{ __IMAGE_DEFAULT__ }}"  
               data-init="{{ __IMAGE_DEFAULT__ }}">
               <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                <i class="fa fa-times"></i></a>
               <input type="hidden" value="" name="content[criteria][{{ $key }}][icon]"  />
               <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
           </div>
       </div>
	</td>
	<td>
		<input type="text" name="content[criteria][{{ $key }}][title]" class="form-control">
	</td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>