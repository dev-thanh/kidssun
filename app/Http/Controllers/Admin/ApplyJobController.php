<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplyJob;
use DataTables;

class ApplyJobController extends Controller
{
    public function getList(Request $request)
    {
    	if ($request->ajax()) {
            $data = ApplyJob::orderBy('created_at', 'DESC')->get();
            return Datatables::of($data)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('name', function ($data) {
                    return $data->name;
                })->addColumn('phone', function ($data) {
                    return $data->phone;
                })->addColumn('email', function ($data) {
                    return $data->email;
                })->addColumn('recruitment', function ($data) {
                	if (!empty(\App\Models\Recruitment::find($data->id_recruitment))) {
                		return \App\Models\Recruitment::find($data->id_recruitment)->name;
                	}
                    return '---';
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Đã xử lý</span>';
                    } else {
                        $status = ' <span class="label label-danger">Chưa xử lý</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('get.edit.job', $data->id) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Xem
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('apply-job.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>';
                })->rawColumns(['checkbox', 'type', 'phone', 'name', 'email', 'status', 'action', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
    	return view('backend.apply-job.list');
    }

    public function getEdit($id)
    {
    	$data = ApplyJob::findOrFail($id);
    	return view('backend.apply-job.edit', compact('data'));
    }

    public function postEdit($id, Request $request)
    {
    	$data = ApplyJob::findOrFail($id);
    	$data->status = $request->status == 1 ?? 0;
    	$data->save();
    	flash('Cập nhật trạng thái thành công.')->success();
        return back();
    }

    public function postDeleteMuti(Request $request)
    {
    	if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                ApplyJob::destroy($id);
            }
            flash('Xóa thành công !')->success();
            return redirect()->back();
        } else {
        	flash('Bạn chưa chọn dữ liệu cần xóa !')->error();
            return redirect()->back();
        }
    }

    public function getDelete($id)
    {
        ApplyJob::destroy($id);
        flash('Xóa thành công !')->success();
        return redirect()->back();
    }
}
