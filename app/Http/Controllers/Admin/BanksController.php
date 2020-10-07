<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banks;

class BanksController extends Controller
{
    protected function fields()
    {
        return [
            'name_bank' => "required",
            'name_account' => "required",
            'number' => "required",
        ];
    }

    protected function messages()
    {
        return [
            'name_bank.required' => 'Tên ngân hàng không được bỏ trống.', 
            'name_account.required' => 'Tên chủ tài khoản không được bỏ trống.',
            'number.required' => 'Số tài khoản không được bỏ trống.',
        ];
    }


    protected function module(){
        return [
            'name' => 'Tài khoản ngân hàng',
            'module' => 'banks',
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
        $data = Banks::where('status','1')->orderBy('created_at','DESC')->get();
        return view('backend.banks.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.banks.create");
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
        $input['status'] = $request->status ? $request->status : 0;
        $data = Banks::create($input);
        flash('Thêm mới thành công.')->success();
        return redirect()->route('banks.index');
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
        $data =Banks::findOrFail($id);
        return view("backend.banks.edit", compact('data'));

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
        $input['status'] = $request->status ? $request->status : 0;
        $data = Banks::findOrFail($id)->update($input);
        flash('Cập nhập thành công.')->success();
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
        Banks::destroy($id);
        flash('Xóa thành công.')->success();
        return redirect()->back();
    }
}
