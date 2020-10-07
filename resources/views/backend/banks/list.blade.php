@extends('backend.layouts.app')
@section('controller', 'Tài khoản ngân hàng' )
@section('controller_route', route('banks.index'))
@section('action', 'Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
                <div class="btnAdd">
                    <a href="{{ route('banks.create') }}">
                        <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
                    </a>
                </div>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <!-- <th><input type="checkbox" name="chkAll" id="chkAll"></th> -->
                            <th class="text-center" width="20px">STT</th>
                            <!-- <th class="text-center">Hình ảnh</th> -->
                            <th class="text-center">Tên ngân hàng</th>
                            <th class="text-center">Tên chủ tài khoản</th>
                            <th class="text-center">Số tài khoản</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <!-- <td class="text-center">{{ $item->image }}</td> -->
                                <td class="text-center">{{ $item->name_bank }}</td>
                                <td class="text-center">{{ $item->name_account }}</td>
                                <td class="text-center">{{ $item->number }}</td>
                                <td class="text-center">
                                    @if($item->status == 1)
                                        <label class="label label-success">Hiển thị trang chủ</label>
                                    @else
                                        <label class="label label-danger">Không hiển thị</label>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div>
                                        <a href="{{ route('banks.edit', ['id'=> $item->id]) }}" title="Sửa">
                                            <i class="fa fa-pencil fa-fw"></i> Sửa
                                        </a> &nbsp; &nbsp; &nbsp;
                                          <a href="javascript:void(0);" class="btn-destroy" 
                                          data-href="{{ route( 'banks.destroy',  $item->id ) }}"
                                          data-toggle="modal" data-target="#confim">
                                          <i class="fa fa-trash-o fa-fw"></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
