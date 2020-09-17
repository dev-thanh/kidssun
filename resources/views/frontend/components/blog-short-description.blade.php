<?php
    $desc = app()->getLocale() == 'vi' ? $item->desc : $item->desc_en;
    $descWords = \Illuminate\Support\Str::words($desc, 40, '...');
?>
<p>{{ $descWords }}
    @if ( str_word_count($desc) > 40)
        <a href="{{ route('home.single-news', ['slug' => $item->slug]) }}" class="btn-read-more">({{ trans('message.xem_them') }})</a>.
    @endif
</p>