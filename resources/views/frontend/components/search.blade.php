<form action="{{ route('home.search') }}" method="GET">
    <div class="icon"><img src="{{ url('/') }}/images/icon-local.png" class="img-fluid" alt="icon"></div>
    <input type="text" class="form-control" name="q" placeholder="{{ trans('message.chon_to_hop_ma_ban_muon_den') }}" autofocus>
</form>