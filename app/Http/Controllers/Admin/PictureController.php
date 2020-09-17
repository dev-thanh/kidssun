<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Picture;
use DataTables;
use File, DB;

class PictureController extends Controller
{
    protected function module(){
        return [
            'name' => 'Hình ảnh',
            'module' => 'picture',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tiêu đề', 
                    'with' => '',
                ],
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '100px',
                ],

            ]
        ];
    }

    protected function fields()
    {
        return [
            'name' => 'required',
            'name_en' => 'required',
            'image' => 'required',
        ];
    }


    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề tiếng việt không được bỏ trống.',
            'name_en.required' => 'Tiêu đề tiếng anh không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh đại diện.',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            $list_tour = Picture::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_tour)
                    ->addColumn('checkbox', function ($data) {
                        return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                    })->addColumn('image', function ($data) {
                        return '<img src="' . $data->image . '" class="img-thumbnail" width="50px" height="50px">';
                    })->addColumn('name', function ($data) {
                        return '<p>Tiếng việt: ' . $data->name . '</p><p>Tiếng anh: ' . $data->name_en . '</p>';
                    })->addColumn('status', function ($data) {
                        if ($data->status == 1) {
                            $status = ' <span class="label label-success">Hiển thị</span>';
                        } else {
                            $status = ' <span class="label label-danger">Không hiển thị</span>';
                        }
                        return $status;
                    })->addColumn('action', function ($data) {
                        return '<a href="' . route('picture.edit', ['id' => $data->id ]) . '" title="Sửa">
                                <i class="fa fa-pencil fa-fw"></i> Sửa
                            </a> &nbsp; &nbsp; &nbsp;
                                <a href="javascript:;" class="btn-destroy" 
                                data-href="' . route('picture.destroy', $data->id) . '"
                                data-toggle="modal" data-target="#confim">
                                <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                            ';
                    })->rawColumns(['checkbox', 'image', 'status', 'action', 'name'])
                    ->addIndexColumn()
                    ->make(true);
        }
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, $this->fields(), $this->messages());

        $input = $request->all();
        $input['status'] = $request->status == 1 ? 1 : null;


        $tour = Picture::create($input);

        flash('Thêm mới thành công.')->success();

        return redirect()->route($this->module()['module'].'.edit', $tour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);
        $data['data'] = Picture::findOrFail($id);
        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->fields(), $this->messages());
        
        $input = $request->all();
        $input['status'] = $request->status == 1 ? 1 : null;

        $tour = Picture::findOrFail($id)->update($input);

        flash('Cập nhật thành công.')->success();

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        flash('Xóa thành công.')->success();

        Picture::destroy($id);

        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Picture::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }
    
}
