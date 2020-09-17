<div class="tab-pane fade show active" id="lib" role="tabpanel" aria-labelledby="lib-tab">
    <div class="content-lib">
        <div class="container">
            <div class="row">
                @foreach ($list_image as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="avarta">
                            <a data-fancybox="group" class ="lightbox" href="{{ $item->image }}" data-fancybox data-caption="Atlanta Skyline">
                                <img src="{{ $item->image }}" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}"/>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="col-sm-12">
        {{ $list_image->links('frontend.components.panigation') }}
    </div>
</div>