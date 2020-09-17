<?php $key = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	{{-- <td class="stt">{{ $index }}</td> --}}
    <td><input type="text" class="form-control" name="content[support][list][{{$key}}][name]" ></td>
    <td><input type="text" class="form-control" name="content[support][list][{{$key}}][name_en]" ></td>
	<td>
        <input type="text" class="form-control" required="" name="content[support][list][{{$key}}][link]">
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>