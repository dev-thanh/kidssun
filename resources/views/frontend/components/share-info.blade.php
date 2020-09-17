<div class="share-info">
    <div class="container">
        <span>{{ ucfirst(trans('message.chia_se_thong_tin_voi_moi_nguoi')) }}</span>
        <ul class="list-inline">
            @foreach ($site_info->social as $item)
                <li class="list-inline-item"><a href="{{ $item->link }}" title="{{ $item->name }}" target="_blank"><i class="{{ $item->icon }}"></i></a></li>
            @endforeach
        </ul>
    </div>
</div>