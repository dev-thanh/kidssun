<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use DataTables;
use File, DB;

class PostController extends Controller
{

    private $type = 'blog';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $list_post = Posts::where('type', $request->type)->orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_post)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' . $data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('author', function ($data) {
                    return $data->Author->name;
                })->addColumn('name', function ($data) {
                    if ($data->type == 'blog') {
                        return '<p>Tiếng việt: ' . $data->name . '</p><p>Tiếng anh: ' . $data->name_en . '</p>'
                        . ' <br><a href="' . asset('tin-tuc/' . $data->slug) . '" target="_black">
                        <i class="fa fa-hand-o-right" aria-hidden="true"></i> Link: 
                        ' . asset('tin-tuc/' . $data->slug) . '
                      </a>';
                    }
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                    if ($data->hot) {
                        $status = $status . ' <span class="label label-primary">Nổi bật</span>';
                    }
                    if ($data->is_new) {
                        $status = $status . ' <span class="label label-info">Mới nhất</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('posts.edit', ['id' => $data->id, 'type' => $data->type]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('posts.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'action', 'name', 'author', 'category'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('backend.posts.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.posts.add',  compact('categories'));
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
                'name'  => 'required',
                'name_en'  => 'required',
                'image' => 'required',
                'type'  => 'required',
            ],
            [
                'name.required'           => 'Tên bài viết tiếng việt không được bỏ trống',
                'name_en.required'        => 'Tên bài viết tiếng anh không được bỏ trống',
                'image.required' => 'Bạn chưa chọn ảnh cho bài viết',
                'type.required'           => 'Sai định dạng.',
            ]
        );

        $input = $request->all();
        $input['slug'] = $this->createSlug(str_slug($request->name));
        $input['status'] = $request->status == 1 ? 1 : null;
        $input['hot'] = $request->hot == 1 ? 1 : null;
        $input['is_new'] = $request->is_new == 1 ? 1 : null;
        $input['user_id'] = \Auth::user()->id;
        
        $post = Posts::create($input);

        flash('Thêm mới thành công.')->success();
        return redirect()->route('posts.index', ['type' => $request->type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = Posts::findOrFail($id);
        return view('backend.posts.edit', $data);
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
            'name'  => 'required',
            'name_en'  => 'required',
            'image' => 'required',
            'type'  => 'required',
        ],
        [
            'name.required'           => 'Tên bài viết tiếng việt không được bỏ trống',
            'name_en.required'        => 'Tên bài viết tiếng anh không được bỏ trống',
            'image.required' => 'Bạn chưa chọn ảnh cho bài viết',
            'type.required'           => 'Sai định dạng.',
        ]
        );

        $input = $request->all();
        $input['status'] = $request->status == 1 ? 1 : null;
        $input['hot'] = $request->hot == 1 ? 1 : null;
        $input['is_new'] = $request->is_new == 1 ? 1 : null;
        $input['user_id'] = \Auth::user()->id;

        $post = Posts::find($id)->update($input);

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
        Posts::destroy($id);
        flash('Xóa thành công.')->success();
        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
         if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                Posts::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return redirect()->back();
        } else {
            flash('Bạn chưa chọn dữ liệu để xóa.')->error();
            return redirect()->back();
        }
    }


    public function getAjaxSlug(Request $request)
    {
        $slug = str_slug($request->slug);
        $id = $request->id;
        $post = Posts::find($id);
        $post->slug = $this->createSlug($slug, $id);
        $post->save();
        return $this->createSlug($slug, $id);
    }

    public function createSlug($slugPost, $id = null)
    {
        $slug = $slugPost;
        $index = 1;
        $baseSlug = $slug;
        while ($this->checkIfExistedSlug($slug, $id)) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = time();
        }

        return $slug;
    }


    public function checkIfExistedSlug($slug, $id = null)
    {
        $type = $this->type;
        if($id != null) {
            $count = Posts::where('type', $type)->where('id', '!=', $id)->where('slug', $slug)->count();
            return $count > 0;
        }else{
            $count = Posts::where('type', $type)->where('slug', $slug)->count();
            return $count > 0;
        }
    }
}
