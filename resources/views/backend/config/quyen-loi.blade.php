@extends('backend.layouts.app')
@section('controller','Quyền lợi của đại lý')
@section('action','Cập nhập')

@section('content')
<style type="text/css" media="screen">
	.deposit{
		display: table;
	}
	.depotit{
		padding: 3px 5px;
    	background: #ccc;
	}
</style>
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
	            <form action="{{route('config.update-quyenloi')}}" method="POST">
	            	@csrf
	               	<div class="col-sm-4 form-group">               		
		           		<label for="">Hoa hồng thưởng trên doanh số nhập(đại lý bán lẻ)</label>
		           		
	               	</div>
	               	<div class="col-sm-8 form-group">  
		           		<input class="form-controll" type="number" value="{{@$quyenloi->hhds_dlbl}}" name="hhds_dlbl">
		           		<label for="startDate" class="depotit">
	                        %
	                    </label>
	               	</div>
	               	<div class="col-sm-4">               		
		           		<label for="">Hoa hồng thưởng khi mở một đại lý bán lẻ mới</label>
		           		
	               	</div>
	               	<div class="col-sm-8 form-group"> 
		           		<input class="form-controll" type="number" value="{{@$quyenloi->hhm_dlbl}}" name="hhm_dlbl">
		           		<label for="startDate" class="depotit">
	                        %
	                    </label>
	               	</div>
	               	<div class="col-sm-4 form-group">               		
		           		<label for="">Hoa hồng thưởng trên doanh số nhập(đại lý phân phối)</label>
	               	</div>
	               	<div class="col-sm-8 form-group"> 
		           		<input class="form-controll" type="number" value="{{@$quyenloi->hhds_dlpp}}" name="hhds_dlpp">
		           		<label for="startDate" class="depotit">
	                        %
	                    </label>
	               	</div>
	               	
	               	<div class="col-sm-4">               		
		           		<label for="">Hoa hồng thưởng toàn kênh DLBl trực tiếp đã mở</label>
	               	</div>
	               	<div class="col-sm-8 form-group"> 
		           		<input class="form-controll" type="number" value="{{@$quyenloi->hhtk_dlbl}}" name="hhtk_dlbl">
		           		<label for="startDate" class="depotit">
	                        %
	                    </label>
	               	</div>
	               	<div class="col-sm-4">               		
		           		<label for="">Hoa hồng thưởng toàn trên kênh NPP trực tiếp đã mở</label>
	               	</div>
	               	<div class="col-sm-8 form-group">
		           		<input class="form-controll" type="number" class="form-group" value="{{@$quyenloi->hhtk_dlpp}}" name="hhtk_dlpp">
		           		<label for="startDate" class="depotit">
	                        %
	                    </label>
	               	</div>
	               	<div class="col-sm-12 form-group">	               		
		               	<button class="btn btn-success" type="submit">Lưu lại</button>
	               	</div>
	            </form>
           </div>
        </div>
	</div>
	@section('scripts')
	<script type="text/javascript">
        
    </script>
    @endsection
@stop