@extends('backend.layouts.app')
@section('controller','Trang')
@section('controller_route',route('pages.list'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<div class="nav-tabs-custom">
			        <ul class="nav nav-tabs">
			            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Tất cả các trang</a></li>
			        </ul>
			    </div>

			    <div class="table-translate">
			        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" 
			        style="display: none">Thêm mới trang</button>
			        <table class="table table-hover">
			            <thead>
			                <tr>
			                    <th width="30px">STT</th>
			                    <th width="">Tên trang</th>
			                    <th width="">Liên kết</th>
			                    <th width="">Hành động</th>
			                </tr>
			            </thead>
			            <tbody class="table-body-pro">
							@foreach ($data as $item)
			                    <tr>
			                        <td>{{ $loop->index + 1 }}</td>
			                        <td>{{ $item->name_page }}</td>
			                        <td>
			                            @if (Route::has($item->route))
			                                <a href="{{ route($item->route) }}" target="_blank">
			                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
			                                    Link: {{ route($item->route) }}
			                                </a>
			                            @else
			                            ---------------
			                            @endif
			                        </td>
			                        <td>
			                            <a href="{{ route('pages.build', ['page'=> $item->type, 'lang' => $item->lang ]) }}" 
			                                class="btn btn-success btn-sm">
			                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Xây dựng trang</a>
			                        </td>
			                    </tr>
			                @endforeach
			            </tbody>
			        </table>
			    </div>
			    <div class="modal fade" id="modal-default">
			        <form action="{{ route('pages.create') }}" method="POST">
			            {{ csrf_field() }}
			            <div class="modal-dialog">
			                <div class="modal-content">
			                    <div class="modal-header">
			                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                            <span aria-hidden="true">×</span></button>
			                        <h4 class="modal-title">Thêm mới</h4>
			                    </div>
			                    <div class="modal-body">
			                        <div class="form-group">
			                            <label for="">Tiêu đề</label>
			                            <input type="text" name="name_page" class="form-control">
			                        </div>
			                        <div class="form-group">
			                            <label for="">Key</label>
			                            <input type="text" name="type" class="form-control">
			                        </div>
			                        <div class="form-group">
			                            <label for="">Route</label>
			                            <input type="text" name="route" class="form-control">
			                        </div>
			                    </div>
			                    <div class="modal-footer">
			                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			                        <button type="submit" class="btn btn-primary">Lưu lại</button>
			                    </div>
			                </div>
			            </div>
			        </form>
			    </div>
            </div>
        </div>
    </div>
@stop