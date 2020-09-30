<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Member;
use App\Models\Rank;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Rechage;
use App\Models\Taikhoan_khachhang;
use App\Models\Log_profits;
use App\Models\BangLuong;
use Carbon\Carbon;
use Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function module(){
        return [
            'name' => 'Bảng lương',
            'module' => 'orders',
            'table' =>[
                
                'link_aff' => [
                    'title' => 'Mã tài khoản', 
                    'with' => '',
                ],

                
                'full_name' => [
                    'title' => 'Họ và tên', 
                    'with' => '',
                ],
                'code' => [
                    'title' => 'Cấp bậc', 
                    'with' => '',
                ],
                'money' => [
                    'title' => 'Tổng lương', 
                    'with' => '',
                ],
                
            ]
        ];
    }
    public function index(Request $request)
    {
        if($request->startdate){
            $stdf = $request->startdate;         
            $endf = $request->enddate;         
            $start_format = Carbon::parse($request->startdate);
            $start_format->format('Y-m-d');
            $end_format = Carbon::parse($request->enddate);
            $end_format->format('Y-m-d');
            $data = Member::where('active',1)->whereBetween('created_at', [$start_format, $end_format])->get();
            return view('backend.member.list', compact('data','stdf','endf'));
        }
        
        $data = Member::all();
        return view('backend.member.list', compact('data'));
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
        //
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
        Member::destroy($id);
        flash('Xóa thành công.')->success();
        return back();
    }
    public function lockMember($id){
        Member::find($id)->update(['lock'=>1]);
        flash('Đã khóa thành công.')->success();
        return back();
    }
    public function unlocklockMember($id){
        Member::find($id)->update(['lock'=>0]);
        flash('Mở khóa thành công.')->success();
        return back();
    }
    public function filterDate(Request $request){
        $start_format = Carbon::parse($request->startdate);
        $start_format->format('Y-m-d');
        $end_format = Carbon::parse($request->enddate);
        $end_format->format('Y-m-d');
        $member = Member::where('status',1)->whereBetween('created_at', [$start_format, $end_format])->get();
        return $member;
    }
    public function rankMember(){
        $rank = Rank::all();
        return view('backend.member.rank',compact('rank'));
    }
    public function addRankMember(){
        $rank = Rank::all();
        return view('backend.member.add_rank',compact('rank'));
    }
    public function postAddRankMember(Request $request){
        //dd($request->all());
        $array = [
            [
                'id'=>$request->id_1,
                'name'=>1,          
                'money_from'=>$request->money_from1,
                'money_to'=>$request->money_to1,
                'deposit'=>$request->deposit1,
            ],
            [
                'id'=>$request->id_2,
                'name'=>2,
                'money_from'=>$request->money_from2,
                'money_to'=>$request->money_to2,
                'deposit'=>$request->deposit2,
            ],
            [
                'id'=>$request->id_3,
                'name'=>3,
                'money_from'=>$request->money_from3,
                'deposit'=>$request->deposit3,
            ],
            [
                'id'=>$request->id_4,
                'name'=>4,
                'money_from'=>$request->money_from4,
                'deposit'=>$request->deposit4,
            ],
            [
                'id'=>$request->id_5,
                'name'=>5,
                'money_from'=>$request->money_from5,
                'deposit'=>$request->deposit5,
            ]
        ];
            
        foreach ($array as $value) {
            Rank::find($value['id'])->update($value);
        }
        // dd($array);
        // Rank::insert($array);

        flash('Sửa thành công.')->success();
        return redirect()->route('member.rank');
    }

    public function member_Detail ($id){
        $member = Member::find($id);

        $recharge = Member::select('recharge.*','member.*','member.user_name as member_name','member.phone as member_phone','member.email as member_email','member.id as member_id')
        ->where('member.id',$id)
        ->join('recharge','recharge.member_id','=','member.id')
        ->get();

        $orders = Order::select('orders.*','status.name as name_status','status.name_en as nameen_status')->where('id_member',$id)
            ->join('status','status.id','=','orders.id_status')
            ->orderBy('orders.created_at', 'desc')->get();

        return view('backend.member.detail',compact('orders','recharge','member'));
        
    }

    public function member_Xacnhan($id){
        $member = Member::find($id);
        $member->xac_nhan = 1;
        $member->save();

        flash('Xác nhận tài khoản thành công')->success();

        return redirect()->route('member.detail',['id'=>$id]);
    }

    public function chiTietDonHang($id){
        $order_details = Order_detail::select('order_detail.*','products.name as product_name','products.name_en as product_name_en')
        ->where('order_id',$id)
        ->join('products','products.id','order_detail.product_id')
        ->get();

        return view('frontend.pages.account.chi-tiet-don-hang',compact('order_details'));
    }

    public function bang_Luong(Request $request){
            if(!$request->month){
                $month = date('m');
            }else{
                $month = $request->month;
            }
            if(!$request->year){
                $year = date('yy');
            }else{
                $year = $request->year;
            }
            
            $bangluong = BangLuong::select('bang_luong.money','member.*')->where('bang_luong.luong_thang',$year.'-'.$month)
            ->join('member','member.id','=','bang_luong.id_daily')
            ->get();
            
            $array_id = $bangluong->pluck('id')->toArray();
            $luong = Log_profits::select('member.id','member.full_name as full_name','member.code as code','member.link_aff as link_aff')
                // ->join('status','status.id','=','log_profits.id_status')
                ->join('member','member.id','=','log_profits.id_nguoinhan')
                ->where(function($q) use ($request,$month,$year,$array_id){

                    $q->whereNotIn('id_nguoinhan',$array_id);
                    
                    $start_format = $year.'-'.$month.'-01';
                   
                    $end_format = $year.'-'.$month.'-31';

                    $q->whereBetween('log_profits.ngay_nhan', [$start_format, $end_format]);
                   
                })->orderBy('log_profits.ngay_nhan', 'desc')->distinct()
                ->get();
        $data['module'] = $this->module();
        $data['luong'] = $luong;
        $data['bangluong'] = $bangluong;
        return view("backend.orders.bang-luong", $data);
        //return view('backend.orders.bang-luong',compact('data'));
    }

    public function chi_Tiet_Luong(Request $request, $id){
        //dd($request->all());
        if($request->year && $request->month){
            $month = $request->year.'-'.$request->month;
        }else{
            $month = Carbon::now()->format('Y-m');
        }

        $member_id = $id;

        $member_info = Member::find($member_id);
        $data = Log_profits::select('log_profits.*','status.name as name_status','orders.mavd as mavd')
        ->join('status','status.id','=','log_profits.id_status')
        ->join('orders','orders.id','=','log_profits.id_donhang')
        ->where(function($q) use ($member_id,$month){

            $q->where([
                'id_nguoinhan' => $member_id,
                // 'active' => 0
            ]);
           
            $start_format = $month.'-01';
           
            $end_format = $month.'-31';

            $q->whereBetween('log_profits.ngay_nhan', [$start_format, $end_format]);
           
        })->orderBy('log_profits.ngay_nhan', 'desc')
        ->get();

        $luong_thang_hien_tai = BangLuong::where(['id_daily'=>$member_id,'luong_thang'=>$month])->first();
        
         return view('backend.member.chi-tiet-luong',compact('data','member_id','luong_thang_hien_tai','member_info'));
    }

    public function xac_Nhan_Luong(Request $request){
        //dd($request->all());
        $bangluong = new BangLuong();
        $bangluong->id_daily = $request->id_daily;
        $bangluong->luong_thang = date('yy').'-'.date('m');
        $bangluong->money = $request->money;
        $bangluong->bu_tru = $request->bu_tru;
        $bangluong->noidung = $request->noi_dung;
        $bangluong->save();

        Log_profits::whereIn('id',$request->checked_id)->update(['active'=>1]);

        flash('Đã tính lương thành công cho đại lý');
        return back();

    }
}
