<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td><input type="text" class="form-control" name="content[social][{{$id}}][name]" ></td>
	<td><input type="text" class="form-control" name="content[social][{{$id}}][icon]" required=""></td>
	<td>
        <input type="text" class="form-control" required="" name="content[social][{{$id}}][link]">
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>