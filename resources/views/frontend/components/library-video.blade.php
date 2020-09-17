<div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
    <div class="container">
        <div class="content">
            <div class="list-tab-video slide-video">
                <div class="row">
                    @foreach ($list_video as $key => $item)
                        <div class="col-md-4 col-sm-6">
                            <div class="item">
                                <div class="avarta"><img src="{{ $item->image }}" class="img-fluid" width="100%" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}"></div>
                                <div class="icon-play">
                                <a href="javascript:0" data-toggle="modal" data-target="#myModal_{{ $key }}"><img src="{{ url('/') }}/images/play.png" class="img-fluid" title="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}" alt="{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12">
                {{ $list_video->links('frontend.components.panigation') }}
            </div>
        </div>
    </div>
</div>