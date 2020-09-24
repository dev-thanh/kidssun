<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Recharge;
use App\Models\Member;
use App\Models\Logs;
use App\Models\Taikhoan_khachhang;

class RechargeController extends Controller
{
    
    protected function module(){
        return [
            'name' => 'Danh sách chuyển khoản',
            'module' => 'recharge',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh bil', 
                    'with' => '70px',
                ],
                'sender' => [
                    'title' => 'Tên người chuyển', 
                    'with' => '',
                ],
                'amount_money' => [
                    'title' => 'Số tiền chuyển', 
                    'with' => '',
                ],
                'trading_code' => [
                    'title' => 'Mã giao dịch', 
                    'with' => '',
                ],
                
                'id_status' => [
                    'title' => 'Trạng thái', 
                    'with' => '100px',
                ],
               
            ]
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $list_products = Recharge::select('recharge.*','member.id as member_id')
                ->join('member','member.id','=','recharge.member_id')
                ->orderBy('created_at', 'DESC')
                ->get();
            return Datatables::of($list_products)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' .url('/').'/public/images/naptien/'.$data->member_id.'_'.$data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('sender', function ($data) {

                    return $data->sender;
                })->addColumn('amount_money', function ($data) {
                    $money = number_format($data->amount_money, 0, '.', '.').' đ';

                    return $money;
                })->addColumn('trading_code', function ($data) {
                    
                    return $data->trading_code;
                })->addColumn('id_status', function ($data) {
                    if ($data->id_status == 1) {
                        $status = ' <span class="label label-primary">Chờ xác nhận</span>';
                    } elseif($data->id_status == 2){
                        $status = ' <span class="label label-success">Thành công</span>';
                    }else{
                        $status = ' <span class="label label-danger">Đã hủy</span>';
                    }
                    
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('recharge.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Xem
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('recharge.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })->rawColumns(['checkbox', 'image', 'sender','bankname', 'amount_money', 'trading_code', 'id_status','action'])
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data['data'] = Recharge::select('recharge.*','status.stt','status.name','member.user_name as member_name','member.phone as member_phone','member.email as member_email','member.id as member_id')
        ->join('status','status.id','=','recharge.id_status')
        ->join('member','member.id','=','recharge.member_id')
        ->where('recharge.id',$id)->first();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recharge::destroy($id);

        flash('Xóa thành công.')->success();

        return redirect()->back();
    }
    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            // foreach ($request->chkItem as $id) {
                Recharge::destroy($request->chkItem);
            // }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }

    public function update_Money($id){

    }
    public function xac_nhan_chuyen_tien(Request $request){
        if($request->id_status == 2){           
            $id = $request->id;
            $member = Member::findOrFail($id);
            $curent_money = $member->tiennap !='' ? $member->tiennap : 0;
            $new_money = $curent_money+$request->money;
            $input['tiennap'] = $new_money;
            $member->update($input);
            $status['id_status']=$request->id_status;
            $recharge = Recharge::findOrFail($request->id_recharge)->update($status);

            flash('Cập nhập trạng thái đã nhận được tiền thành công')->success();
            return redirect()->route('recharge.index');
        }else{
            $recharge = Recharge::findOrFail($request->id_recharge)->update(['id_status'=>$request->id_status]);
            flash('Xác nhận đã hủy.')->error();
            return redirect()->route('recharge.index');
        }
               
    }
}
