<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Contact;
use App\Models\Customer;

class ContactController extends Controller
{
    public function getListContact(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::with('Customer')->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('name', function ($data) {
                    return $data->Customer->name;
                })->addColumn('phone', function ($data) {
                    return $data->Customer->phone;
                })->addColumn('email', function ($data) {
                    return $data->Customer->email;
                })->addColumn('type', function ($data) {
                    return 'Liên hệ từ khách hàng';
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Đã xem</span>';
                    } else {
                        $status = ' <span class="label label-danger">Chưa xem</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('contact.edit', $data->id) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Xem
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('contact.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>';
                })->rawColumns(['checkbox', 'type', 'phone', 'name', 'email', 'status', 'action', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('backend.contact.list');
    } 

    public function postDeleteMuti(Request $request)
    {
        if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                Contact::destroy($id);
            }
            flash('Xóa thành công !')->success();
            return redirect()->back();
        } else {
        	flash('Bạn chưa chọn dữ liệu cần xóa !')->error();
            return redirect()->back();
        }
    }

    public function getEdit($id)
    {
        $data = Contact::with('Customer')->findOrFail($id);
        return view('backend.contact.edit', compact('data'));
    }

    public function postEdit(Request $request, $id)
    {
        $contact = Contact::find($id);
        if ($contact->status == 0) {
            $contact->status = $request->status == 1 ? 1 : 0;
            $contact->save();
        }
        flash('Cập nhật trạng thái thành công !')->success();
        return redirect()->route('get.list.contact');

    }

    public function getDelete($id)
    {
        Contact::destroy($id);
        flash('Xóa thành công !')->success();
        return redirect()->back();
    }
}
