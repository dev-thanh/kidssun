<script>
jQuery(document).ready(function ($) {
    $('#table-ajax').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            'url': '{{ $route }}',
        },
        columns: [
            {data: 'checkbox', name: 'checkbox'},
            {data: 'DT_RowIndex',name: 'DT_RowIndex'},
            @foreach ($module['table'] as $key => $item)
                {data: '{{ $key }}', name: '{{ $key }}'},
            @endforeach
            {data: 'action', name: 'action'},
        ],
        'columnDefs': [{
            'targets': [0, 1],
            'orderable': false,
            'searchable': false,
        }],
        language: {
            "sProcessing": "Đang xử lý...",
            "sLengthMenu": "Xem _MENU_ mục",
            "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
            "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix": "",
            "sSearch": "Tìm:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Đầu",
                "sPrevious": "Trước",
                "sNext": "Tiếp",
                "sLast": "Cuối"
            }
        }
    });
});
</script>