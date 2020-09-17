@extends('backend.layouts.app')
@section('controller','Liên hệ')
@section('controller_route',route('get.list.contact'))
@section('action','Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')

                <form action="{!! route('contact.postMultiDel') !!}" method="POST">
			        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
			        <div class="btnAdd">
			          <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')"><i class="fa fa-trash-o"></i> Xóa</button>
			        </div>
			        <table id="table-ajax" class="table table-bordered table-striped table-hover">
			          	<thead>
				          <tr>
				            <th width="10px"><input type="checkbox" name="chkAll" id="chkAll"></th>
				            <th width="10px">STT</th>
				            <th>Họ tên</th>
				            <th>Số điện thoại</th>
				            <th>Email</th>
				            <th>Tiêu đề</th>
				            <th>Thời gian gửi</th>
				            <th width="90px">Trạng thái</th>
				            <th width="100px">Thao tác</th>
				          </tr>
			          	</thead>
				        <tbody>
				                
				        </tbody>
			        </table>
			    </form>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        jQuery(document).ready(function($) {
            $('#table-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('get.list.contact') !!}',
                columns: [
                    { data: 'checkbox', name: 'checkbox' },
                    { data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'title', name: 'title' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                    
                ],
                'columnDefs': [{
                    'targets': [0,1], 
                    'orderable': false,
                    'searchable': false,
                }],
                language:{
                    "sProcessing":   "Đang xử lý...",
                    "sLengthMenu":   "Xem _MENU_ mục",
                    "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                    "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Tìm:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Đầu",
                        "sPrevious": "Trước",
                        "sNext":     "Tiếp",
                        "sLast":     "Cuối"
                    }
                }
            });
        });
    </script>
@endsection