<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\Order;
use App\Models\Rank;
use App\Models\Log_profits;
use App\Models\Order_detail;
use App\Models\Quyenloi;

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
        if($request->status == 2){
            $order = Order::find($request->id);

            $id_member = $order->id_member;

            $member = Member::find($id_member);

            $mentor = Member::where('id',$member->mentor)->first();
            //$childrent = Member::where('mentor',$member->id)->get();
            $quyenloi = Quyenloi::first();
            
            $hhds_dlbl = $quyenloi->hhds_dlbl;
            $hhm_dlbl = $quyenloi->hhm_dlbl;
            $hhds_dlpp = $quyenloi->hhds_dlpp;
            $hhtk_dlbl = $quyenloi->hhtk_dlbl;
            $hhtk_dlpp = $quyenloi->hhtk_dlpp;
            $order_success = Order::where(
                [
                    'id_member' => $id_member,
                    'id_status' => 2
                ]
            )->get();

            /* Lấy số tiền của cấp đại lý */
            $rank = Rank::all();
            $tien_dlbl = 0;
            $tien_dlpp = 0;
            foreach ($rank as $val) {
                if($val->key==1){
                    $tien_dlbl = $val->total;
                }
                if($val->key==2){
                    $tien_dlpp = $val->total;
                }
            }

            $capdo = $member->code;

            $tongtien_truoc = 0;
            foreach ($order_success as $value) {
                $tongtien_truoc+=$value->tongtien;
            }
            $tien_donhang_hientai = $order->tongtien;

            $tongtien = $tien_donhang_hientai+$tongtien_truoc;

            if($capdo =='CTV'){

                /*  Tiền cộng cho chính đại lý đó khi nạp hơn 6tr  */
                if($tongtien >= $tien_dlbl && $tongtien < $tien_dlpp){
                    
                    $member->code = 'DLBL';
                    $member->save();
                    if($tongtien > $tien_dlbl){
                        $sodu = $tien_donhang_hientai-($tien_dlbl-$tongtien_truoc);
                        $log_profits = new Log_profits;
                        $log_profits->id_donhang = $request->id;
                        $log_profits->id_nguoinhan = $member->id;
                        $log_profits->name_nguoinhan = $member->full_name;
                        $log_profits->money = $sodu*$hhds_dlbl/100;
                        $log_profits->id_status = 4;
                        $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                        $log_profits->save();
                        
                    }
                }
               
                if($tongtien >= $tien_dlpp){
                    $member->code = 'DLPP';
                    $member->save();
                    
                    $log_profits = new Log_profits;
                    $log_profits->id_donhang = $request->id;
                    $log_profits->id_nguoinhan = $member->id;
                    $log_profits->name_nguoinhan = $member->full_name;
                    $log_profits->money = ($tien_dlpp-$tien_dlbl)*$hhds_dlbl/100;
                    $log_profits->id_status = 4;
                    $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                    $log_profits->save();

                    if($tongtien > $tien_dlpp){
                        $sodu = $tongtien-$tien_dlpp;
                        $log_profits = new Log_profits;
                        $log_profits->id_donhang = $request->id;
                        $log_profits->id_nguoinhan = $member->id;
                        $log_profits->name_nguoinhan = $member->full_name;
                        $log_profits->money = $sodu*$hhds_dlpp/100;
                        $log_profits->id_status = 4;
                        $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                        $log_profits->save();
                    }
                }


                /*  Tiền cộng cho đại lý giới thiệu  */
                // $mentor = Member::where('id',$member->mentor)->first();
                if($mentor){
                    if($mentor->code == 'DLBL' || $mentor->code == 'DLPP'){

                        if($mentor->code == 'DLBL'){

                            $log_profits = new Log_profits;
                            $log_profits->id_donhang = $request->id;
                            $log_profits->id_nguoinhan = $mentor->id;
                            $log_profits->name_nguoinhan = $mentor->full_name;
                            $log_profits->id_capduoi = $member->id;
                            $log_profits->name_capduoi = $member->full_name;
                            $log_profits->id_status = 5;
                            $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                            if($tongtien <= $tien_dlbl){
                                $log_profits->money = $tien_donhang_hientai*$hhm_dlbl/100;
                            }else{
                                $log_profits->money = ($tien_dlbl-$tongtien_truoc)*$hhm_dlbl/100;
                            }
                            $log_profits->save();

                        }else{


                            if($tongtien <= $tien_dlbl){
                                $log_profits = new Log_profits;
                                $log_profits->id_donhang = $request->id;
                                $log_profits->id_nguoinhan = $mentor->id;
                                $log_profits->name_nguoinhan = $mentor->full_name;
                                $log_profits->id_capduoi = $member->id;
                                $log_profits->name_capduoi = $member->full_name;
                                $log_profits->id_status = 5;
                                $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                                $log_profits->money = $tien_donhang_hientai*20/100;
                                $log_profits->save();
                            }elseif($tongtien > $tien_dlbl && $tongtien <= $tien_dlpp){
                                $log_profits = new Log_profits;
                                $log_profits->id_donhang = $request->id;
                                $log_profits->id_nguoinhan = $mentor->id;
                                $log_profits->name_nguoinhan = $mentor->full_name;
                                $log_profits->id_capduoi = $member->id;
                                $log_profits->name_capduoi = $member->full_name;
                                $log_profits->id_status = 5;
                                $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                                $log_profits->money = ($tien_dlbl-$tongtien_truoc)*$hhtk_dlpp/100;
                                $log_profits->save();
                                /*  Tiền cộng cho dlpp khi ctv trở thành dlbl  */
                                $sd = $tongtien-$tien_dlbl;
                                $log_profits = new Log_profits;
                                $log_profits->id_donhang = $request->id;
                                $log_profits->id_nguoinhan = $mentor->id;
                                $log_profits->name_nguoinhan = $mentor->full_name;
                                $log_profits->id_capduoi = $member->id;
                                $log_profits->name_capduoi = $member->full_name;
                                $log_profits->id_status = 5;
                                $log_profits->money = $sd*$hhtk_dlbl/100;
                                $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                                $log_profits->save();
                            }else{
                                $log_profits = new Log_profits;
                                $log_profits->id_donhang = $request->id;
                                $log_profits->id_nguoinhan = $mentor->id;
                                $log_profits->name_nguoinhan = $mentor->full_name;
                                $log_profits->id_capduoi = $member->id;
                                $log_profits->name_capduoi = $member->full_name;
                                $log_profits->id_status = 5;
                                $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                                $log_profits->money = ($tien_dlbl-$tongtien_truoc)*$hhtk_dlpp/100;
                                $log_profits->save();
                                /*  Tiền cộng cho dlpp khi ctv trở thành dlbl  */
                                $sd = $tongtien-$tien_dlbl;
                                $log_profits = new Log_profits;
                                $log_profits->id_donhang = $request->id;
                                $log_profits->id_nguoinhan = $mentor->id;
                                $log_profits->name_nguoinhan = $mentor->full_name;
                                $log_profits->id_capduoi = $member->id;
                                $log_profits->name_capduoi = $member->full_name;
                                $log_profits->id_status = 5;
                                $log_profits->money = ($tien_dlpp-$tien_dlbl)*$hhtk_dlbl/100;
                                $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                                $log_profits->save();
                            }
                        }
                    }
                }

            }elseif($capdo =='DLBL')
            {
                /*  Tiền cộng cho chính đại lý đó khi trở thành DLBL  */
                if($tongtien < $tien_dlpp)
                {
                    
                    $log_profits = new Log_profits;
                    $log_profits->id_donhang = $request->id;
                    $log_profits->id_nguoinhan = $member->id;
                    $log_profits->name_nguoinhan = $member->full_name;
                    $log_profits->money = $tien_donhang_hientai*$hhds_dlbl/100;
                    $log_profits->id_status = 6;
                    $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                    $log_profits->save();
                    if($mentor){
                        if($mentor->code=='DLPP')
                        {
                            $log_profits = new Log_profits;
                            $log_profits->id_donhang = $request->id;
                            $log_profits->id_nguoinhan = $mentor->id;
                            $log_profits->name_nguoinhan = $mentor->full_name;
                            $log_profits->id_capduoi = $member->id;
                            $log_profits->name_capduoi = $member->full_name;
                            $log_profits->money = $tien_donhang_hientai*$hhtk_dlbl/100;
                            $log_profits->id_status = 5;
                            $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                            $log_profits->save();
                        }
                    }

                    
                }else
                {
                    if($tongtien >= $tien_dlpp)
                    {
                        $member->code = 'DLPP';
                        $member->save();
                    }
                    $sd = $tongtien-$tien_dlpp;
                    $log_profits = new Log_profits;
                    $log_profits->id_donhang = $request->id;
                    $log_profits->id_nguoinhan = $member->id;
                    $log_profits->name_nguoinhan = $member->full_name;
                    $log_profits->money = $sd*$hhds_dlpp/100;
                    $log_profits->id_status = 6;
                    $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                    $log_profits->save();

                    $log_profits = new Log_profits;
                    $log_profits->id_donhang = $request->id;
                    $log_profits->id_nguoinhan = $member->id;
                    $log_profits->name_nguoinhan = $member->full_name;
                    $log_profits->money = ($tien_dlpp - $tongtien_truoc)*$hhds_dlbl/100;
                    $log_profits->id_status = 6;
                    $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                    $log_profits->save();
                    if($mentor){
                        if($mentor->code=='DLPP')
                        {
                            $log_profits = new Log_profits;
                            $log_profits->id_donhang = $request->id;
                            $log_profits->id_nguoinhan = $mentor->id;
                            $log_profits->name_nguoinhan = $mentor->full_name;
                            $log_profits->id_capduoi = $member->id;
                            $log_profits->name_capduoi = $member->full_name;
                            $log_profits->money = ($tien_dlpp - $tongtien_truoc)*$hhtk_dlbl/100;
                            $log_profits->id_status = 5;
                            $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                            $log_profits->save();
                        }
                    }
                }
            }elseif($capdo =='DLPP')
            {
                $log_profits = new Log_profits;
                $log_profits->id_donhang = $request->id;
                $log_profits->id_nguoinhan = $member->id;
                $log_profits->name_nguoinhan = $member->full_name;
                $log_profits->money = $tien_donhang_hientai*$hhds_dlpp/100;
                $log_profits->id_status = 6;
                $log_profits->ngay_nhan = Carbon::now()->format('Y-m-d');
                $log_profits->save();
            }
        }

        $order->update(['id_status'=>$request->status]);

        
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
    public function edit(Request $request,$id)
    {   

        $data['order'] = Order::select('orders.*','orders.id as order_id','status.name as name_status','member.full_name as full_name','member.*')
            ->where('orders.id',$id)      
            ->join('status','status.id','=','orders.id_status')
            ->join('member','member.id','=','orders.id_member')
            ->first();

        $data['order_details'] = Order_detail::select('order_detail.*','products.name as product_name','products.name_en as product_name_en','products.image as image')
        ->join('products','products.id','order_detail.product_id')
        ->where('order_id',$id)
        ->where(function($q) use ($request) {
            if($request->startdate !=''){
                $start_format = Carbon::parse($request->startdate);
                $start_format->format('Y-m-d');
                $end_format = Carbon::parse($request->enddate);
                $end_format->format('Y-m-d');
                $q->whereBetween('order_detail.created_at', [$start_format, $end_format]);
            }           
        })->orderBy('order_detail.created_at', 'desc')
        ->get();
        //dd($data['order_details']);
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

    public function doanhThu(Request $request){
        if (request()->ajax()) {

            $list_log = Log_profits::select('log_profits.*','status.name as name_status','orders.mavd as mavd')
            ->join('status','status.id','=','log_profits.id_status')
            ->join('orders','orders.id','=','log_profits.id_donhang')
            ->where(function($q) use ($request){
                if($request->start_date !=''){
                    $start_format = Carbon::parse($request->start_date);
                    $start_format->format('Y-m-d');
                    $end_format = Carbon::parse($request->end_date);
                    $end_format->format('Y-m-d');
                }else{
                    $month = date('m');
                    $year = date('yy');
                    $start_format = '01-'.$month.'-'.$year;
                    $end_format = '31-'.$month.'-'.$year;
                }
                
                $q->whereBetween('log_profits.ngay_nhan', [$start_format, $end_format]);
                
            })->orderBy('log_profits.id', 'desc')
            ->get();

            return Datatables::of($list_log)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('name_nguoinhan', function ($data) {
                    return $data->name_nguoinhan;
                })->addColumn('mavd', function ($data) {
                    return $data->mavd;
                })->addColumn('money', function ($data) {
                    return number_format($data->money, 0, '.', '.').'đ';
                })->addColumn('ngay_nhan', function ($data) {
                    return format_datetime($data->ngay_nhan,'d-m-Y');
                })->addColumn('name_status', function ($data) {
                    return $data->name_status;
                    
                })->rawColumns(['checkbox', 'name_nguoinhan', 'mavd', 'money', 'ngay_nhan', 'name_status'])
                ->addIndexColumn()
                ->make(true);

        }

        return view('backend.orders.doanh-thu');
    }

    public function bang_Luong(Request $request){
        $data = Member::all();
        // foreach ($member as $value) {
        //     echo $this->doanh_Thu($value->id).'</br>';
        // }
        return view('backend.orders.bang-luong',compact('data'));
    }
}
