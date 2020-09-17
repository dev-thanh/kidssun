<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;

class CategoryController extends Controller
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
            'name' => 'Danh mục dự án',
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['module'] = $this->module();
        $data['data'] = Categories::where('type', 'product_category')->get();
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
        $data['categories'] = Categories::where('type', 'product_category')->get();
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

        $post_check_sulg = Categories::where('slug', $request->slug)->where('type', 'product_category')->first();
        if (!empty($post_check_sulg)) {
            return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);
        }

        $input = $request->all();

        $input['type'] = 'product_category';

        $data = Categories::create($input);

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

        $data['categories'] = Categories::where('id', '!=', $id)->where('type', 'product_category')->get();

        $data['data'] = Categories::findOrFail($id);

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

        $post_check_sulg = Categories::where('slug', $request->slug)->where('id', '!=', $id)->where('type', 'product_category')->first();
        if (!empty($post_check_sulg)) {
            return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);
        }
        $input = $request->all();

        $input['is_display_home'] = $request->is_display_home == 1 ? 1 : null;

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

            flash('Không thể xóa danh mục này vì danh mục này đang có danh mục con.')->error();
            return redirect()->route('category.index');

        }else {

            Categories::destroy($id);

            flash('Xóa thành công.')->success();

            return redirect()->route('category.index');

        }
    }

}
