<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\ProjectCategory;
use DataTables;
use Carbon\Carbon;

class ProjectController extends Controller
{
	protected function module(){
        return [
            'name' => 'Dự án',
            'module' => 'projects',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tên dự án', 
                    'with' => '',
                ],
                'category' => [
                    'title' => 'Danh mục', 
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
            'image' => 'required',
        ];
    }


    protected function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh cho sản phẩm.',
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
            $list_products = Projects::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_products)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' . $data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('name', function ($data) {
                        return $data->name.'<br><a href="'.route('home.single-project', $data->slug).'" target="_blank">'.route('home.single-project', $data->slug).'</a>';
                })->addColumn('category', function ($data) {
                        return @\App\Models\Categories::find($data->type)->name;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                    if ($data->hot) {
                        $status = $status . ' <span class="label label-primary">Nổi bật</span>';
                    }
                    if ($data->is_price) {
                        $status = $status . ' <span class="label label-primary">Hiển thị ở trang báo giá</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('projects.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('projects.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'action', 'name', 'category'])
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
        
        $data = [
            'name' => $request->name,
            'content' => $request->content,
            'image' => $request->image,
            'more_image' => !empty($request->gallery) ? json_encode($request->gallery) : null,
            'status' => $request->status == 1 ? 1 : null,
            'hot' => $request->hot == 1 ? 1 : null,
            'is_price' => $request->is_price == 1 ? 1 : null,
            'slug' => $this->createSlug(str_slug($request->name)),
            'type' => !empty($request->type_project) ? $request->type_project : null,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $project = Projects::insert($data);

        flash('Thêm mới thành công.')->success();

        return redirect()->route("{$this->module()['module']}.index");
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
        $data['data'] = Projects::findOrFail($id);
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

        $data = [
            'name' => $request->name,
            'content' => $request->content,
            'image' => $request->image,
            'more_image' => !empty($request->gallery) ? json_encode($request->gallery) : null,
            'status' => $request->status == 1 ? 1 : null,
            'hot' => $request->hot == 1 ? 1 : null,
            'is_price' => $request->is_price == 1 ? 1 : null,
            'type' => !empty($request->type_project) ? $request->type_project : null,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
        ];
        $project = Projects::findOrFail($id)->update($data);

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

        Projects::destroy($id);

        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Projects::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }


    public function getAjaxSlug(Request $request)
    {
        $slug = str_slug($request->slug);
        $id = $request->id;
        $post = Projects::find($id);
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
        if($id != null) {
            $count = Projects::where('id', '!=', $id)->where('slug', $slug)->count();
            return $count > 0;
        }else{
            $count = Projects::where('slug', $slug)->count();
            return $count > 0;
        }
    }



}
