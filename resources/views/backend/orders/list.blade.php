@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', 'Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
                <form action="" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    @include('backend.layouts.components.table')
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <?php $url = route($module['module'].'.index'); ?>
    @include('backend.layouts.components.table-js-config', ['route'=> $url ])
@endsection