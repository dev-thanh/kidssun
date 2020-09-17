<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	{{-- <td class="index">{{ $index }}</td> --}}
	<td>
        <div class="form-group">
            <input type="text" class="form-control" name="content[process][content][{{ $key }}][year]" value="{{ @$value->year }}">
        </div>
	</td>
	<td>
        <div class="form-group">
            <textarea id="content{{ $key }}" name="content[process][content][{{ $key }}][desc_process]">{{ @$value->desc_process }}</textarea>
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