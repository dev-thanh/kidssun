@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])

    @else
        <div class="alert alert-{{ $message['level'] }} {{ $message['important'] ? 'alert-important' : '' }}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo</h4>
            {!! $message['message'] !!}
        </div>
    @endif
@endforeach
{{ session()->forget('flash_notification') }}

@if(count($errors) > 0)
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Thông báo</h4>
    @foreach($errors->all() as $error)
        <li>{!! $error !!}</li>
     @endforeach
  </div>
@endif
