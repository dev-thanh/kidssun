@if ($type == 'news')
	@if (count($data))
		@foreach ($data as $item)
			<div class="col-md-4 col-sm-4 col-6">
				@component('frontend.components.post', ['item' => $item]) @endcomponent
			</div>
		@endforeach
	@endif
@else
	@if (count($data))
		@foreach ($data as $item)
			<div class="col-md-6 col-sm-6">
				@if (!empty($info))
					@component('frontend.components.project', ['item' => $item, 'info'=> $info ]) @endcomponent
				@else
					@component('frontend.components.project', ['item' => $item ]) @endcomponent
				@endif
			</div>
		@endforeach
	@endif
@endif