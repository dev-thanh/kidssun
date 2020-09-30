<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Options;
use App\Models\Recruitment;
use DateTime;
use SEO;
use SEOMeta;
use OpenGraph;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Validator;
use Carbon\Carbon;
use Image;
use File;
use Cart;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Exports\LichsuagiaodichExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Recharge;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Status;
use App\Models\Rank;
use App\Models\Log_profits;

class ManagerAccountController extends Controller
{
	public $config_info;

    public function __construct()
    {
        $site_info = Options::where('type', 'general')->first();
        if ($site_info) {
            $site_info = json_decode($site_info->content);
            $this->config_info = $site_info;

            OpenGraph::setUrl(\URL::current());
            OpenGraph::addProperty('locale', 'vi');
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('author', 'GCO-GROUP');

            SEOMeta::addKeyword($site_info->site_keyword);

            $menuHeader = Menu::where('id_group', 1)->orderBy('position')->get();
            view()->share(compact('site_info', 'menuHeader'));
        }
    }

    public function createSeo($dataSeo = null)
    {
        $site_info = $this->config_info;
        if (!empty($dataSeo->meta_title)) {
            SEO::setTitle($dataSeo->meta_title);
        } else {
            SEO::setTitle($site_info->site_title);
        }
        if (!empty($dataSeo->meta_description)) {
            SEOMeta::setDescription($dataSeo->meta_description);
            OpenGraph::setDescription($dataSeo->meta_description);
        } else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($dataSeo->image)) {
            OpenGraph::addImage($dataSeo->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($dataSeo->meta_keyword)) {
            SEOMeta::addKeyword($dataSeo->meta_keyword);
        }
    }

    public function createSeoPost($data)
    {
        if(!empty($data->meta_title)){
            SEO::setTitle($data->meta_title);
        }else {
            SEO::setTitle($data->name);
        }
        if(!empty($data->meta_description)){
            SEOMeta::setDescription($data->meta_description);
            OpenGraph::setDescription($data->meta_description);
        }else {
            SEOMeta::setDescription($this->config_info->site_description);
            OpenGraph::setDescription($this->config_info->site_description);
        }
        if (!empty($data->image)) {
            OpenGraph::addImage($data->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($this->config_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($data->meta_keyword)) {
            SEOMeta::addKeyword($data->meta_keyword);
        }
    }

    public function makeStringFriendly($text)
    {
        //Characters must be in ASCII
        $text = html_entity_decode($text);
        $text = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/','a',$text);
        $text = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/','e',$text);
        $text = preg_replace('/(ì|í|ị|ỉ|ĩ)/','i',$text);
        $text = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $text);
        $text = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $text);
        $text = preg_replace('/(ỳ|ý|ỷ|ỵ|ỹ)/','y',$text);
        $text = preg_replace('/(đ)/', 'd', $text);
        $text = preg_replace('/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẫ|Ẩ|Ă|Ằ|Ắ|Ẳ|Ặ|Ẵ)/','A', $text);
        $text = preg_replace('/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ể|Ễ|Ệ)/', 'E', $text);
        $text = preg_replace('/(Ì|Í|Ỉ|Ị|Ĩ)/', 'I', $text);
        $text = preg_replace('/(Ò|Ó|Ỏ|Ọ|Õ|Ô|Ồ|Ố|Ổ|Ộ|Ỗ|Ơ|Ờ|Ớ|Ở|Ợ|Ỡ)/','O', $text);
        $text = preg_replace('/(Ù|Ú|Ủ|Ụ|Ũ|Ư|Ừ|Ứ|Ử|Ự|Ữ)/', 'U', $text);
        $text = preg_replace('/(Ỳ|Ý|Ỷ|Ỵ|Ỹ)/', 'Y', $text);
        $text = preg_replace('/(Đ)/', 'D', $text);
        $text = preg_replace('/(!|@|"|#|\$|%|\^|\(|\)|{|}|\[|\]|\*|~|`|=|\+|\'|;|,|:|&|<|>|\?|\/)/', '', $text);
        
        $text = str_replace(' - ','-',$text);
        $text = str_replace('_','-',$text);
        $text = str_replace(' ','-',$text);
        //$text = ereg_replace('[^A-Za-z0-9-]', '', $text);
        
        $text = str_replace('----','-',$text);
        $text = str_replace('---','-',$text);
        $text = str_replace('--','-',$text);
        
        $text = strtolower($text);
        return $text;
    }

    public function thongTinTaiKhoan(){
    	$member = Auth::guard('customer')->user();
    	return view('frontend.pages.account.thong-tin-tai-khoan',compact('member'));
    }

    public function postUpdateAccount(Request $request){
    	$member_id = Auth::guard('customer')->user()->id;
    	if (Lang::locale() == 'vi'){           
            $message = [
                'full_name.required' => 'Họ tên không được để trống',
                'full_name.min' => 'Họ tên ít nhất phải 6 kí tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email này đã có người sử dụng',
                'phone.required' => 'Số điện thoại không được để trống',
                'so_cmnd.required' => 'Số chứng minh nhân dân(thẻ căn cước) không được để trống',
                'so_cmnd.numeric' => 'Số chứng minh nhân dân(thẻ căn cước) không hợp lệ',
                'so_cmnd.min' => 'Số chứng minh nhân dân(thẻ căn cước) không hợp lệ',
                'cmnd1.required' => 'Vui lòng chọn ảnh chứng minh thư mặt trước',
                'cmnd2.required' => 'Vui lòng chọn ảnh chứng minh thư mặt sau',
                'cmnd1.image' => 'Vui lòng chọn đúng file ảnh.',
                'cmnd2.image' => 'Vui lòng chọn đúng file ảnh.',
                'cmnd1.mimes' => 'Chỉ chấp nhận hình ảnh có đuôi jpeg,png,jpg,jpeg',
                'cmnd2.mimes' => 'Chỉ chấp nhận hình ảnh có đuôi jpeg,png,jpg,jpeg',
            ];
            $success = 'Cập nhập tài khoản thành công';
            $error = 'Cập nhập không thành công,vui lòng thử lại';
        }else{
            $message = [
                'full_name.required' => 'Full name cannot be left blank',
                'full_name.min' => 'Full name must be at least 6 characters',
                'email.required' => 'Email cannot be left blank',
                'email.email' => 'Email invalidate',
                'email.unique' => 'This email is already in use',
                'phone.required' => 'Phone number can not be left blank',
                'so_cmnd.required' => 'Identification number (identity card) cannot be left blank',
                'so_cmnd.numeric' => 'Invalid identity card (ID) number',
                'so_cmnd.min' => 'Invalid identity card (ID) number',
                'cmnd1.required' => 'Please choose a photo of your ID card in front',
                'cmnd2.required' => 'Please select the back photo of your ID card',
                'cmnd1.image' => 'Please select the correct image file.',
                'cmnd2.image' => 'Please select the correct image file.',
                'cmnd1.mimes' => 'Only images with extensions are accepted: jpeg,png,jpg,jpeg',
                'cmnd2.mimes' => 'Only images with extensions are accepted: jpeg,png,jpg,jpeg',
            ];
            $success = 'Account update is successful';
            $error = 'The update failed, please try again';
        }
        $fields = [
            'full_name' => 'required|min:6',
            'email' => ['required','email',Rule::unique('member')->ignore($member_id)],
            'phone' => 'required',
            'so_cmnd' => 'required|numeric|min:7',
        ];
        if($request->cmnd1_key ==''){
        	$fields['cmnd1'] = 'required|image|mimes:jpeg,png,jpg,jpeg|max:3048';
        	$fields['cmnd2'] = 'required|image|mimes:jpeg,png,jpg,jpeg|max:3048';
        }else{
        	if($request->hasFile('cmnd1')){
        		$fields['cmnd1'] = 'required|image|mimes:jpeg,png,jpg,jpeg|max:3048';
        	}
        	if($request->hasFile('cmnd2')){
        		$fields['cmnd2'] = 'required|image|mimes:jpeg,png,jpg,jpeg|max:3048';
        	}
        }
        $input = $request->all();
        
        $validator = Validator::make($input, $fields,$message);
   
        if ($validator->passes()) {
        	$member = Member::findOrFail($member_id);
        	$cmnd1_old = $member->cmnd1;
        	$cmnd2_old = $member->cmnd2;
        	
        	if($request->hasFile('cmnd1')){
	        	$image1 = $request->file('cmnd1');
		        $name1 = $image1->getClientOriginalName();
		        $image_name1 = $this->makeStringFriendly($name1);
			    $destinationPath = public_path('images');
			    $input['cmnd1'] = $image_name1;

			    $resize_image1 = Image::make($image1->getRealPath());

			    $resize_image1->resize(250, null, function($constraint){
			      $constraint->aspectRatio();
			    })->save($destinationPath . '/' . $member_id.'_'.$image_name1);
			    if($cmnd1_old !=''){
			    	$path = public_path('/images/').$member->id.'_'.$cmnd1_old;
			    	if (File::exists($path)) File::delete($path);
			    }
			}
			if($request->hasFile('cmnd2')){
				$image2 = $request->file('cmnd2');
			    $name2 = $image2->getClientOriginalName();
		        $image_name2 = $this->makeStringFriendly($name2);
			    $destinationPath = public_path('images');

			    $resize_image2 = Image::make($image2->getRealPath());

			    $resize_image2->resize(250, null, function($constraint){
			      $constraint->aspectRatio();
			    })->save($destinationPath . '/' . $member_id.'_'.$image_name2);

			    $input['cmnd2'] = $image_name2;
			    if($cmnd1_old !=''){
			    	$path = public_path('/images/').$member->id.'_'.$cmnd2_old;
			    	if (File::exists($path)) File::delete($path);
			    }
			}
		    $member->update($input);
		   	return response()->json([
                'toastr' => $success,
               	'status' => 1
        	]);
		}
		return response()->json(['error'=>$validator->errors()]);
    }

    public function postUpdatePassword(Request $request){
    	$member_id = Auth::guard('customer')->user()->id;
    	$member = Member::findOrFail($member_id);
    	if (Lang::locale() == 'vi'){           
            $message = [
                'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
                'new_password.required' => 'Vui lòng nhập mật khẩu mới',
                'new_password.min' => 'Mật khẩu mới ít nhất 6 kí tự',
                'renew_password.required' => 'Vui lòng nhập lại mật khẩu mới',
                
            ];
            $success = 'Thay đổi mật khẩu thành công';
            $error = 'Cập nhập không thành công,vui lòng thử lại';
            $password_false = 'Cập nhập không thành công,vui lòng thử lại';
            $password_old = 'Mật khẩu cũ không chính xác';
        }else{
            $message = [
                'old_password.required' => 'Please enter old password',
                'new_password.required' => 'Please enter a new password',
                'new_password.min' => 'New password at least 6 characters',
                'renew_password.required' => 'Please re-enter your new password',
                
            ];
            $success = 'Password changed successfully';
            $error = 'The update failed, please try again';
            $password_false = 'The password does not match';
            $password_old = 'Old password is incorrect';
        }
        $fields = [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'renew_password' => 'required',
        ];

        $input = $request->all();
        
        $validator = Validator::make($input, $fields,$message);
        if ($validator->passes()) {        	
	        if(Hash::check($request->old_password, $member->password)){
	        	if($request->new_password === $request->renew_password){
	        		$member->update(['password' => Hash::make($request->new_password)]);
	                return response()->json([
		                'toastr' => $success,
		               	'status' => 1
		        	]);
	        	}else{
	        		$validator->errors()->add('password_false', $password_false);
	        	}     	
	        }else{
		        $validator->errors()->add('old_password', $password_old);
	        }
        }
        return response()->json(['error'=>$validator->errors()]);
    }

    public function bankAccount(Request $request){
    	$member_id = Auth::guard('customer')->user()->id;
    	$member = Member::findOrFail($member_id);
        return view('frontend.pages.account.tai-khoan-ngan-hang',compact('member'));
    }

    public function postBankAccount(Request $request){
    	if (Lang::locale() == 'vi'){           
            $message = [
                'bank_name.required' => 'Tên tài khoản không được để trống',
                'bank_account.required' => 'Số tài khoản không được để trống',
                'bank_account.min' => 'Số tài khoản không hợp lệ',
                'bank_account_name.required' => 'Tên chủ tài khoản không được để trống',
            ];
            $success = 'Cập nhập tài khoản ngân hàng thành công';
            $error = 'Cập nhập tài khoản không thành công';
        }else{
            $message = [
                'bank_name.required' => 'Account name cannot be left blank',
                'bank_account.required' => 'Account number cannot be left blank',
                'bank_account.min' => 'Invalid account number',
                'bank_account_name.required' => 'The name of the account holder cannot be left blank',
                
            ];
            $success = 'Bank account update successfully';
            $error = 'Bank account update failed';
        }

        $fields = [
            'bank_name' => 'required',
            'bank_account_name' => 'required',
            'bank_account' => 'required|min:8',
        ];

        $input = $request->all();

        $validator = Validator::make($input, $fields,$message);
        if ($validator->fails())
	    {	       
			return  redirect()->back()
	            ->withErrors($validator)
	            ->withInput()->with(['error'=>$error]);
	    }
    	$member_id = Auth::guard('customer')->user()->id;
    	$member = Member::findOrFail($member_id);
    	
    	$member->update($input);
    	return back()->with(['success'=>$success]);
    }

    public function napTien(){
    	return view('frontend.pages.account.nap-tien');
    }

    public function postNapTien(Request $request){
    	//dd($request->all());
    	$member_id = Auth::guard('customer')->user()->id;
    	if (Lang::locale() == 'vi'){           
            $message = [
                'sender.required' => 'Tên người gửi không được để trống.',
                'bankname.required' => 'Bạn chưa chọn ngân hàng gửi.',
                'amount_money.required' => 'Số tiền gửi không được để trống.',
                'receiver.required' => 'Bạn chưa chọn người nhận.',
                'trading_code.required' => 'Mã giao dịch không được để trống.',
                'trading_code.min' => 'Mã giao dịch không hợp lệ.',
                'filename.required' => 'Bạn chưa chọn hình ảnh bil chuyển tiền.',
                'filename.image' => 'Vui lòng chọn đúng file ảnh.',
                'filename.mimes' => 'Chỉ chấp nhận hình ảnh có đuôi jpeg,png,jpg,jpeg.',
            ];
            $success = 'Nạp tiền thành công,chúng tối sẽ xác nhận trong thời gian sớm nhất';
            $error = 'Nạp tiền không thành công,vui lòng xác nhận lại';
        }else{
            $message = [
                'sender.required' => 'The sender name cannot be left blank.',
                'bankname.required' => 'You have not selected a sending bank.',
                'amount_money.required' => 'Deposit amount cannot be left blank.',
                'receiver.required' => 'You have not selected a recipient',
                'trading_code.required' => 'Transaction code cannot be left blank.',
                'trading_code.min' => 'Invalid transaction code.',
                'filename.required' => 'You have not selected the image of money transfer bil.',
                'filename.image' => 'Please select the correct image file.',
                'filename.mimes' => 'Only images with extensions are accepted: jpeg,png,jpg,jpeg.',
            ];
            $success = 'Deposit successfully, we will confirm in the shortest time.';
            $error = 'Deposit failed, please confirm again.';
        }

        $fields = [
            'sender' => 'required',
            'bankname' => 'required',
            'amount_money' => 'required',
            'receiver' => 'required',
            'trading_code' => 'required|min:6',
            'filename' => 'required|image|mimes:jpeg,png,jpg,jpeg|max:3048',
        ];

        $input = $request->all();

        $validator = Validator::make($input, $fields,$message);

        if ($validator->passes()) {  
        	if($request->hasFile('filename')){
	        	$image = $request->file('filename');
		        $name = $image->getClientOriginalName();
		        $image_name = $this->makeStringFriendly($name);
			    $destinationPath = public_path('images/naptien');
			    $input['image'] = $image_name;

			    $resize_image = Image::make($image->getRealPath());

			    $resize_image->resize(250, null, function($constraint){
			      $constraint->aspectRatio();
			    })->save($destinationPath . '/' . $member_id.'_'.$image_name);
			}
			$input['id_status'] = 1;
			$input['member_id'] = $member_id;

			$option = json_decode(Options::where('type', 'general')->first()->content);

        	$email_admin = !empty($option->email_admin) ? $option->email_admin : 'dangthanh151293@gmail.com';

        	$content_email = [
	            'title' => 'Thông tin nạp tiền từ khách hàng',
	            'name' => $request->sender,
	            'bankname' => $request->bankname,
	            'amount_money' => number_format($request->amount_money, 0, '.', '.').' đ',
	            'image' => url('/').'/public/images/naptien/'.$member_id.'_'.$image_name,
	            'trading_code' => $request->trading_code,
	            'node' => $request->note,
	            'url' => 'dfdsfsd',
	            
	        ];
	        Mail::send('frontend.mail.mail-teamplate', $content_email, function ($msg) use($email_admin) {
	            $msg->from('no.reply.bot.gco@gmail.com', 'Website - Kids Sun Việt Nam');
	            $msg->to($email_admin, 'Website - Kids Sun Việt Nam')->subject('Khách hàng nạp tiền');
	        });

			Recharge::create($input);

		   	return response()->json([
                'toastr' => $success,
               	'status' => 1
        	]);
		}

		return response()->json(['error'=>$validator->errors()]);
    }

    public function recharge_list($request,$member_id){
    	$recharge = Recharge::select('recharge.*','status.name as name_status','status.name_en as nameen_status')
            ->join('status','recharge.id_status','=','status.id')
            ->where(['recharge.member_id'=>$member_id])
            ->where(function($q) use ($request) {
                if($request->start_date !=''){
                    $start_format = Carbon::parse($request->start_date);
                    $start_format->format('Y-m-d');
                    $end_format = Carbon::parse($request->end_date);
                    $end_format->format('Y-m-d');
                    $q->whereBetween('recharge.created_at', [$start_format, $end_format]);
                }           
                if($request->search !=''){
                    $q->where('trading_code', 'LIKE', '%' . $request->search . '%');
                }
            })->orderBy('recharge.created_at', 'desc')->get();
        return $recharge;
    }
    /*  Lịch sử giao dịch  */
    public function TransactionHistory(Request $request){
    	$member_id = Auth::guard('customer')->user()->id;	  

        $recharge = $this->recharge_list($request,$member_id);

    	return view('frontend.pages.account.lich-su-nap-tien',compact('recharge'));
    }

    /*  Xuất exel lịc sử dai dịch  */
    public function export_Lichsu_Giaodich(Request $request){
        
        $member_id = Auth::guard('customer')->user()->id;

        $recharge = $this->recharge_list($request,$member_id);

        $array_export = [];

        foreach ($recharge as $item) {
            $status = $item->name_status;            
            $array = [
                'Ngày '.format_datetime($item->created_at,'d-m-y').'',
                'Nạp tiền',
                $item->trading_code, 
                number_format($item->amount_money, 0, '.', ',').' đ',
                $status
            ];
            array_push($array_export,$array);
            
        }
        $export = new LichsuagiaodichExport($array_export);
        return Excel::download($export, 'lichsu_giaodich.xlsx');
    }

    public function datHang(){
    	$member_id = Auth::guard('customer')->user()->id;
    	$member = Member::findOrFail($member_id);
    	if (Cart::count()) {
    		$order = new Order;
    		$order->mavd = 'DH'.$member_id.Carbon::now()->format('dmYHis');
    		$order->tongtien = Cart::total();
    		$order->id_member = $member_id;
    		$order->mentor = $member->mentor;
    		$order->code = $member->code;
    		$order->id_status = 1;
    		$order->save();

    		foreach (Cart::content() as $item) {
	            $orderDetail                   = new Order_detail;
	            $orderDetail->order_id         = $order->id;
	            $orderDetail->mavd         = $order->mavd;
	            $orderDetail->product_id       = $item->id;
	            $orderDetail->qty 			   = $item->qty;
	            $orderDetail->price            = $item->price;
	            $orderDetail->price_total      = $item->price * $item->qty;
	            $orderDetail->save();
	        }

	        Cart::destroy();
	        return redirect()->route('home.list-products')->with([
	            'success' => 'Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ xác nhận trong thời gian sớm nhất.',
	        ]);

    	}
    	return back()->with([
            'error' => 'Chưa có sản phẩm trong giỏ hàng',
        ]);
    }

    public function lichSuMuaHang(Request $request){
    	$member_id = Auth::guard('customer')->user()->id;
    	$orders = Order::select('orders.*','status.name as name_status','status.name_en as nameen_status')->where('id_member',$member_id)
	    	->join('status','status.id','=','orders.id_status')
	    	->where(function($q) use ($request) {
                if($request->start_date !=''){
                    $start_format = Carbon::parse($request->start_date);
                    $start_format->format('Y-m-d');
                    $end_format = Carbon::parse($request->end_date);
                    $end_format->format('Y-m-d');
                    $q->whereBetween('orders.created_at', [$start_format, $end_format]);
                }           
                if($request->status !=''){
                    $q->where('orders.id_status',$request->status);
                }
            })->orderBy('orders.created_at', 'desc')->get();

            $all_status = Status::where('type',1)->get();
    	return view('frontend.pages.account.lich-su-mua-hang',compact('orders','all_status'));
    }

    public function chiTietDonHang($id){
    	$order_details = Order_detail::select('order_detail.*','products.name as product_name','products.name_en as product_name_en')
    	->where('order_id',$id)
    	->join('products','products.id','order_detail.product_id')
    	->get();

    	return view('frontend.pages.account.chi-tiet-don-hang',compact('order_details'));
    }

    public function lichSuMuaHangDaiLyCapDuoi(Request $request){
    	$member_id = Auth::guard('customer')->user()->id;

    	$thanhvien = Member::where('mentor',$member_id)->get();

    	$all_status = Status::where('type',1)->get();
    	$member_id_array =[];
    	foreach ($thanhvien as $value) {
    		array_push($member_id_array,$value->id);
    	}

    	$orders = Order::select('orders.*','status.name as name_status','status.name_en as nameen_status','member.full_name as full_name','member.link_aff as link_aff')
	    	->where(function($q) use ($request,$member_id_array){
			    if($request->mentor ==''){
			    	$q->whereIn('id_member',$member_id_array);
			    }else{
			    	$q->where('id_member',$request->mentor);
			    }
			})			
	    	->join('status','status.id','=','orders.id_status')
	    	->join('member','member.id','=','orders.id_member')
	    	->where(function($q) use ($request) {
                if($request->start_date !=''){
                    $start_format = Carbon::parse($request->start_date);
                    $start_format->format('Y-m-d');
                    $end_format = Carbon::parse($request->end_date);
                    $end_format->format('Y-m-d');
                    $q->whereBetween('orders.created_at', [$start_format, $end_format]);
                }           
                if($request->status !=''){
                    $q->where('orders.id_status',$request->status);
                }
            })->orderBy('orders.created_at', 'desc')->get();

    	return view('frontend.pages.account.lich-su-mua-hang-dlcd',compact('orders','all_status','thanhvien'));
    }

    public static function doanhthu_Daily($member){
        $dangnhap = Auth::guard('customer')->user();

        $doanhthu =0;
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
        if($member->code=='DLBL' || $member->code=='DLPP')
        {
            $tong = 0;
            $order_success = Order::where([
                'id_status' => 2,
                'id_member' => $member->id
            ])->get();
            foreach ($order_success as $item) {
                $tong+=$item->tongtien;
            }
            return $tong-$tien_dlbl;

        }else{
            return 0;
        }
    }

    public static function tongtien_Donhang_Thanhcong_Daily($member){
        $tong_tien = 0;
        $order_success = Order::where([
            'id_status' => 2,
            'id_member' => $member->id
        ])->get();
        foreach ($order_success as $item) {
            $tong_tien+=$item->tongtien;
        }
        return $tong_tien;
    }
    public function quanLyDaiLy(Request $request){
    	$member_id = Auth::guard('customer')->user()->id;

    	if($request->daily !=''){

	    	$thanhvien = Member::where('id',$request->daily)->get();

	    }else{

	    	$thanhvien = Member::where(function($q) use ($request,$member_id) {
	    		$q->where('mentor',$member_id);
			    if($request->start_date !=''){
                    $start_format = Carbon::parse($request->start_date);
                    $start_format->format('Y-m-d');
                    $end_format = Carbon::parse($request->end_date);
                    $end_format->format('Y-m-d');
                    $q->whereBetween('member.created_at', [$start_format, $end_format]);
                }
			})->orderBy('member.created_at', 'desc')->get();

	    }

    	return view('frontend.pages.account.quan-ly-dai-ly',compact('thanhvien'));
    }

    public function doanh_Thu(Request $request){
        $member_id = Auth::guard('customer')->user()->id;

        $data = Log_profits::select('log_profits.*','status.name as name_status','status.name_en as name_status_en','orders.mavd as mavd')
        ->join('status','status.id','=','log_profits.id_status')
        ->join('orders','orders.id','=','log_profits.id_donhang')
        ->where(function($q) use ($request,$member_id){
            $q->where([
                'id_nguoinhan' => $member_id,
                'active' => 1,
            ]);
            if($request->start_date !=''){
                $start_format = Carbon::parse($request->start_date);
                $start_format->format('Y-m-d');
                $end_format = Carbon::parse($request->end_date);
                $end_format->format('Y-m-d');
                $q->whereBetween('log_profits.ngay_nhan', [$start_format, $end_format]);
            } 
        })->orderBy('log_profits.ngay_nhan', 'desc')
        ->get();

        return view('frontend.pages.account.doanh-thu',compact('data'));
    }
}
