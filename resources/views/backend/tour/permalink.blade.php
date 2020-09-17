<label class="control-label required" for="current-slug" aria-required="true">Đường dẫn:</label>
<span id="sample-permalink">
	<a class="permalink" target="_blank" href="{{ asset('chuyen-du-lich-noi-bat/'.$data->slug ) }}">
    	<span class="default-slug">
    		{{ asset('chuyen-du-lich-noi-bat') }}/<span id="editable-post-name">{{ $data->slug }}</span>
    	</span>
	</a>
</span>
<span id="edit-slug-buttons">
    <button type="button" class="btn btn-secondary" id="change_slug">Sửa</button>
    <button type="button" class="save btn btn-secondary" id="btn-ok" style="display: none;">Ok</button>
    <button type="button" class="cancel button-link">Hủy</button>
</span>
<input type="hidden" id="current-slug"  value="{{ $data->slug }}">
<input type="hidden" id="baseUrl" value="{{ asset('chuyen-du-lich-noi-bat') }}">
<input type="hidden" id="idPost" value="{{ $data->id }}">


