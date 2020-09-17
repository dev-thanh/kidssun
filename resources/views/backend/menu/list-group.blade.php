@extends('backend.layouts.app') 
@section('controller','Menu')
@section('controller_route', route('setting.menu'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
				<table id="example1" class="table table-bordered table-striped table-hover">
	            <thead>
		            <tr>
		                <th>STT</th>
		                <th>Tiêu đề</th>
		                <th>Vị trí</th>
		                <th>Thao tác</th>
		            </tr>
	            </thead>
	            <tbody>
	                @foreach ($data as $item)
	                    <tr>
	                        <td>{{ $loop->index +1 }}</td>
	                        <td>{{ $item->title }}</td>
	                        <td>{{ $item->position }}</td>
	                        <td>
	                            <a href="{{ route('backend.config.menu.edit',$item->id ) }}">
	                                <i class="fa fa-pencil fa-fw"></i> Sửa Menu
	                            </a>
	                        </td>
	                    </tr>
	                @endforeach
	            </tbody>
	        </table>
            </div>
        </div>
    </div>
@stop
