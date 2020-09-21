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
use Image;
use File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Menu;

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
   //      if ($validator->fails())
	  //   {	       
			// return  redirect()->back()
	  //           ->withErrors($validator)
	  //           ->withInput()->with(['error'=>$error]);			
	  //   }
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
}
