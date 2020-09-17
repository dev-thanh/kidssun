<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<div class="form-group">
			<label for="">Mốc thời gian</label>
			<input type="text" name="content[history][content][{{ $key }}][title]" class="form-control" value="{{ @$value->title }}">
		</div>
		<div class="form-group">
			<label for="">Mô tả</label>
			<textarea id="content{{ $key }}" name="content[history][content][{{ $key }}][content]">{!! @$value->content !!}</textarea>
		</div>
	</td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
<script>
	CKEDITOR.replace( 'content{{ $key }}' );
</script>