<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;

class CategoriesController extends Controller
{
    protected function fields()
    {
        return [
            'name' => "required",
            'slug' => "required",
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được bỏ trống.', 
            'slug.required' => 'Đường dẫn tĩnh không được bỏ trống.',
        ];
    }


    protected function module(){
        return [
            'name' => 'Danh mục sản phẩm',
            'module' => 'category',
            'table' =>[
                'name' => [
                    'title' => 'Tiêu đề', 
                    'with' => '',
                ],
                'slug' => [
                    'title' => 'Liên kết', 
                    'with' => '',
                ],
            ]
        ];
    }

    public function index()
    {
        $data['module'] = $this->module();
        $data = Categories::orderBy('created_at', 'DESC')->get();
        return view("backend.categoryproduct.list",compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Categories::all();
        $array_id = Categories::where('status', 1)->pluck('parent_id')->toArray();
        return view("backend.categoryproduct.create",compact('data','array_id'));
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

        $post_check_sulg = Categories::where('slug', $request->slug)->first();
        // if (!empty($post_check_sulg)) {
        //     return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);
        // }

        $input = $request->all();
        $input['slug'] = $this->createSlug(str_slug($request->name));
        $input['status'] = $request->status == 1 ? 1 : null;
        if($request->parent_id == 0)
        {
            $input['level'] = 1;
        }else{
            $level = Categories::find($request->parent_id)->level;
            $input['level'] = $level+1;
        }
        Categories::create($input);
        flash('Thêm mới thành công.')->success();
               
            
        return redirect()->route("category.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $data['categories'] = Categories::all();

        $data['data'] = Categories::findOrFail($id);
        // dd($arrayid);
        return view("backend.categoryproduct.edit", $data);
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

        $post_check_sulg = Categories::where('slug', $request->slug)->where('id', '!=', $id)->first();
        // if (!empty($post_check_sulg)) {
        //     return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);
        // }
        $input = $request->all();
        $input['slug'] = $this->createSlug(str_slug($request->name));
        $input['status'] = $request->status == 1 ? 1 : null;
        if($request->parent_id == 0)
        {
            $input['level'] = 1;
        }else{
            $level = Categories::find($request->parent_id)->level;
            $input['level'] = $level+1;
        }        
        
        Categories::findOrFail($id)->update($input);

        flash('Cập nhật thành công.')->success();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id)->get_child_cate();

        if(count($category)){

            flash('Không thể xóa danh mục chứa danh mục con.')->error();

            return redirect()->route('category.index');

        }else {

            Categories::destroy($id);

            flash('Xóa thành công.')->success();

            return redirect()->route('category.index');

        }
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
            $count = Categories::where('id', '!=', $id)->where('slug', $slug)->count();
            return $count > 0;
        }else{
            $count = Categories::where('slug', $slug)->count();
            return $count > 0;
        }
    }
}
