<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Image::where('type',$request->type)->orderBy('created_at', 'DESC')->get();
        return view('backend.image.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.image.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'image' => 'required',
                'name'  => 'max:100',
            ],
            [
                'image.required' => 'Bạn chưa chọn ảnh',
                'name.max'       => 'Trường tiêu đề phải nhỏ hơn 100 ký tự.'
            ]
        );
        $data = [
            'image' => $request->image,
            'name' => $request->name,
            'link' => $request->link,
            'decs' => $request->decs,
            'status' => $request->status == 1 ? 1 : 0,
            'type' => $request->type
        ];

       
        $image = Image::create($data);
        flash('Thêm mới thành công.')->success();
        return redirect()->route('images.index', ['type' => $request->type]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Image::findOrFail($id);

        return view('backend.image.edit', compact('data'));
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
        $this->validate($request,
            [
                'name' => 'max:100',
                'image' => 'required',
            ],
            [
                'image.required' => 'Bạn chưa chọn ảnh',
                'name.max' => 'Trường tiêu đề phải nhỏ hơn 100 ký tự.'
            ]
        );
        $data = [
            'image' => $request->image,
            'name' => $request->name,
            'link' => $request->link,
            'decs' => $request->decs,
            'status' => $request->status == 1 ? 1 : 0,
            'type' => $request->type
        ];
        $image = Image::find($id)->update($data);
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
        Image::destroy($id);
        flash('Xóa thành công.')->success();
        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                Image::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return redirect()->back();
        }else{
            flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
            return redirect()->back();
        }
    }
}
