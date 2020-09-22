<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Order;
use App\Models\Order_detail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function fields()
    {
        return [
            'name' => 'required',
            'name_en' => 'required',
            'image' => 'required',
            'price' => 'required',
        ];
    }
    


    protected function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được bỏ trống.',
            'name_en.required' => 'Tên sản phẩm bằng tiếng anh không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh cho sản phẩm.',
            'price.required' => 'Giá sản phẩm không được bỏ trống.',
        ];
    }

    
    protected function messages_edit($name)
    {
        return [
            'name.required' => $name.' không được bỏ trống.',
            'name.unique' => $name.' đã tồn tại.',
        ];
    }
    protected function module(){
        return [
            'name' => 'Đơn hàng',
            'module' => 'orders',
            'table' =>[
                
                'mavd' => [
                    'title' => 'Mã đơn hàng', 
                    'with' => '',
                ],

                
                'tongtien' => [
                    'title' => 'Thành tiền', 
                    'with' => '',
                ],
                'created_at' => [
                    'title' => 'Ngày mua', 
                    'with' => '',
                ],
                'id_status' => [
                    'title' => 'Trạng thái', 
                    'with' => '',
                ],
            ]
        ];
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $list_order = Order::select('orders.*','status.name as name_status','member.full_name as full_name','member.link_aff as link_aff')
                  
            ->join('status','status.id','=','orders.id_status')
            ->join('member','member.id','=','orders.id_member')
            ->orderBy('orders.created_at', 'desc')->get();





            //$list_products = Products::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_order)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('mavd', function ($data) {
                    return $data->mavd;
                })->addColumn('tongtien', function ($data) {
                    return number_format($data->tongtien, 0, '.', '.'). ' VNĐ';
                })->addColumn('created_at', function ($data) {
                    return format_datetime($data->created_at,'d-m-Y');
                })->addColumn('id_status', function ($data) {
                    if ($data->id_status == 1) {
                        $status = ' <span class="label label-primary">'.$data->name_status.'</span>';
                    } elseif($data->id_status == 2) {
                        $status = ' <span class="label label-success">'.$data->name_status.'</span>';
                    }else{
                        $status = ' <span class="label label-danger">'.$data->name_status.'</span>';
                    }
                    
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('orders.edit', ['id' => $data->id ]) . '" title="Xem">
                            <i class="fa fa-pencil fa-fw"></i> Xem
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('orders.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })->rawColumns(['checkbox','id_status', 'action', 'mavd','tongtien'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.list", $data);
    }
    public function create(Request $request)
    {   
        $order = Order::findOrFail($request->id);
        if($order){
            $order->update(['id_status'=>$request->status]);
        }
        return redirect()->route('orders.edit', ['id' => $request->id ]);
    }

    public function xacNhanDonHang(Request $request){
        // dd($request->all());
        $order = Order::find($request->id);
        if($order){
            $order->update(['id_status'=>$request->status]);
        }
        if($request->status == 2){
            flash('Đã xác nhận đơn hàng hoàn thành.')->success();
        }else{
            flash('Đã xác nhận hủy đơn hàng.')->error();
        }
        return redirect()->route('orders.edit', ['id' => $request->id ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $data['order'] = Order::select('orders.*','orders.id as order_id','status.name as name_status','member.full_name as full_name','member.*')
            ->where('orders.id',$id)      
            ->join('status','status.id','=','orders.id_status')
            ->join('member','member.id','=','orders.id_member')
            ->first();
            

        $data['order_details'] = Order_detail::select('order_detail.*','products.name as product_name','products.name_en as product_name_en','products.image as image')
        ->where('order_id',$id)
        ->join('products','products.id','order_detail.product_id')
        ->get();
        //dd($data['order']);
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.edit", $data);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
