<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Options;
use App\Models\Recruitment;
use DateTime;
use SEO;
use SEOMeta;
use OpenGraph;
use App\Models\Menu;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Validator;
use Cart;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Customer;
use App\Models\Posts;
use App\Models\Picture;
use App\Models\Video;
use App\Models\Contact;
use App\Models\ApplyJob;
use App\Models\Member;
use App\Models\ResetPassword;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\RecruitmentRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;


class IndexController extends Controller
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

    public function getChangeLanguage($lang)
    {
        session(['lang' => $lang]);
        return redirect()->back();
    }

    public function getHome()
    { 
    	$this->createSeo();
        $contentHome = Pages::where('type', 'home')->whereLang(app()->getLocale())->first();
        $slider = Image::where('status', 1)->where('type', 'slider')->get();
        $partner = Image::where('status', 1)->where('type', 'partner')->get();
        $posts_hot = Posts::where('status', 1)->where('hot', 1)->orderBy('created_at', 'DESC')->get();
    	return view('frontend.pages.home', compact('contentHome', 'slider', 'partner', 'posts_hot'));
    }

    public function getListAbout()
    {
        $dataSeo = Pages::where('type', 'about')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        return view('frontend.pages.about', compact('dataSeo'));
    }

    public function getListRecruitment()
    {
        $dataSeo = Pages::where('type', 'recruitment')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $data = Recruitment::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
        return view('frontend.pages.archives-recruitment', compact('dataSeo', 'data'));
    }

    public function getSingleRecruitment($slug)
    {
        $data = Recruitment::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $recruitment_same = Recruitment::where('id', '!=', $data->id)->where('status', 1)->orderBy('created_at', 'DESC')->take(3)->get();
        return view('frontend.pages.single-recruitment', compact('data', 'recruitment_same'));
    }

    public function getListNew()
    {
        $dataSeo = Pages::where('type', 'news')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $data = Posts::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
        return view('frontend.pages.archives-news', compact('dataSeo', 'data'));
    }

    public function getSingleNews($slug)
    {
        $dataSeo = Pages::where('type', 'news')->whereLang(app()->getLocale())->first();
        $data = Posts::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $news = Posts::where('id', '!=', $data->id)->where('status', 1)->where('is_new', 1)->orderBy('created_at', 'DESC')->take(5)->get();
        $news_same = Posts::where('id', '!=', $data->id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('frontend.pages.single-news', compact('dataSeo', 'data', 'news', 'news_same'));
    }

    public function getListImage()
    {
        $dataSeo = Pages::where('type', 'image')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $data = Picture::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
        return view('frontend.pages.archives-image', compact('dataSeo', 'data'));
    }

    public function getListVideo()
    {
        $dataSeo = Pages::where('type', 'video')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $data = Video::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
        return view('frontend.pages.archives-video', compact('dataSeo', 'data'));
    }

    public function getSingleVideo($slug)
    {
        $dataSeo = Pages::where('type', 'video')->whereLang(app()->getLocale())->first();
        $data = Video::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $news = Posts::where('status', 1)->where('is_new', 1)->orderBy('created_at', 'DESC')->take(5)->get();
        return view('frontend.pages.single-video', compact('dataSeo', 'data', 'news'));
    }

    public function getContact()
    {
        $dataSeo = Pages::where('type', 'contact')->first();
        $this->createSeo($dataSeo);
        return view('frontend.pages.contact', compact('dataSeo'));
    }

    public function postContact(ContactRequest $request)
    {
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ];
        $customer = Customer::create($data);
        $contact = new Contact;
        $contact->title = 'Liên hệ từ khách hàng';
        $contact->customer_id = $customer->id;
        $contact->type = $request->type;
        $contact->content = $request->content;
        $contact->status = 0;
        $contact->save();

        $content_email = [
            'title' => 'Liên hệ từ khách hàng',
            'type' => 'contact',
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'content' => $request->content,
            'url' => route('contact.edit', $contact->id),
        ];

        $email_admin = getOptions('general', 'email_admin');

        Mail::send('frontend.mail.mail-teamplate', $content_email, function ($msg) use($email_admin) {
            $msg->from('no.reply.bot.gco@gmail.com', 'Website - KIDS SUN VIỆT NAM');
            $msg->to($email_admin, 'Website - KIDS SUN VIỆT NAM')->subject('Khách hàng liên hệ');
        });
        return redirect()->back()->with([
            'flash_message' => ucfirst(trans('message.thong_bao_thanh_cong')),
        ]);
    }

    public function postRecruitment(RecruitmentRequest $request)
    {
        if (!empty($request->fileCV)) {
            $cv = $request->fileCV;
            $nameCV = time() . '_' . $cv->getClientOriginalName();
            $path = "uploads/CV/";
            $cv->move($path, $nameCV);
        }
        $applyJob = new ApplyJob;
        $applyJob->name = $request->name;
        $applyJob->phone = $request->phone;
        $applyJob->email = $request->email;
        $applyJob->id_recruitment = $request->id;
        $applyJob->cv = $path . $nameCV;
        $applyJob->status = 0;
        $applyJob->save();

        $content_email = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'id_recruitment' => $request->id,
            'link_cv' => url('/') . '/' . $path . $nameCV,
            'url' => route('get.edit.job', $applyJob->id),
        ];

        $email_admin = getOptions('general', 'email_admin');

        Mail::send('frontend.mail.mail-apply', $content_email, function ($msg) use($email_admin) {
            $msg->from('no.reply.bot.gco@gmail.com', 'Website - KIDS SUN VIỆT NAM');
            $msg->to($email_admin, 'Website - KIDS SUN VIỆT NAM')->subject('Nộp đơn ứng tuyển');
        });
        return redirect()->back()->with([
            'flash_message' => ucfirst(trans('message.thong_bao_thanh_cong')),
        ]);
    }

    public function postMember(Request $request){
        if (Lang::locale() == 'vi'){           
            $message = [
                'full_name.required' => 'Họ tên không được để trống',
                'user_name.required' => 'Tên đăng nhập không được để trống',
                'user_name.unique' => 'Tên đăng nhập này đã có người sử dụng',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email này đã có người sử dụng',
                'phone.required' => 'Số điện thoại không được để trống',
                'password.required' => 'Mật khẩu không được để trống',
                'password.string' => 'Mật khẩu phải là chuỗi kí tự',
                'password.min' => 'Mật khẩu ít nhất phải 6 kí tự',
                'password.confirmed' => 'Nhập lại mật khẩu không khớp',
                'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu'
            ];
            $success = 'Đăng ký thành công, vui lòng đăng nhập lại';
            $mess_code = 'Mã giới thiệu không đúng';
        }else{
            $message = [
                'full_name.required' => 'Full name cannot be left blank',
                'user_name.required' => 'Username cannot be left blank',
                'user_name.unique' => 'This username is already in use',
                'email.required' => 'Email cannot be left blank',
                'email.email' => 'Email invalidate',
                'email.unique' => 'This email is already in use',
                'phone.required' => 'Phone number can not be left blank',
                'password.required' => 'Password number can not be left blank',
                'password.string' => 'Password must be a string of characters',
                'password.min' => 'Password must be at least 6 characters',
                'password.confirmed' => 'Password mismatched again',
                'password_confirmation.required' => 'Please re-enter your password'
            ];
            $success = 'Successful registration, please login again';
            $mess_code = 'Referral code is incorrect';
        }
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'full_name' => 'required',
            'user_name' => 'required|unique:member,user_name',
            'email' => 'required|email|unique:member,email',
            'phone' => 'required',
            'password' => [
                'required',
                'string',
                'min:6', 
                'confirmed',
            ],
            'password_confirmation' => 'required',
        ],$message);


        if ($validator->passes()) {

            $mentor = Member::where('link_aff',$request->mentor_code)->first();
            if(!$mentor){
                return response()->json(['error_code'=>$mess_code]);
            }

            $input['password'] = Hash::make($request->password);
            $input['mentor'] = $mentor->id;
            $input['code'] = 'DLBL';
            $input['link_aff'] = 'KS'.Carbon::now()->format('dmYHis');
            $member = Member::create($input);

            return response()->json(['success'=>$success]);
        }




        return response()->json(['error'=>$validator->errors()]);
    }

    /*  Login  */
    public function postLogin(Request $request){
        $input = $request->all();
        // Auth::guard('customer')->logout();
        // return redirect()->back();
        if (Lang::locale() == 'vi'){
            $message = [
                'name_email.required' => 'Bạn chưa điền tên đăng nhập hoặc email',
                'password_login.required' => 'Bạn chưa nhập mật khẩu'
            ];
            $message_login = 'Tên đăng nhập hoặc mật khẩu không chính xác';
            $message_title= 'Lỗi đăng nhập';
        }else{
            $message = [
                'name_email.required' => 'You have not entered your username or email',
                'password_login.required' => 'You have not entered the password'
            ];
            $message_login = 'Username or password incorrect';
            $message_title= 'Login error';
        }
        
        $validator = Validator::make($input, [
            'name_email' => 'required',
            'password_login' => 'required'
        ],$message);
        if ($validator->passes()) {


            $login_type = filter_var($request->name_email, FILTER_VALIDATE_EMAIL ) 
                ? 'email' 
                : 'user_name';
            if($login_type == 'email'){
                $credentials = array('email' => $request->name_email, 'password' => $request->password_login);
            }else{
                $credentials = array('user_name' => $request->name_email, 'password' => $request->password_login);
            }
           
            if (Auth::guard('customer')->attempt($credentials)) {
                        return response()->json(['status_login'=>1]);
            }

            return response()->json([
                'status_login'=>0,
                'message_login' => $message_login,
                'message_title' => $message_title
            ]);
        }

        return response()->json(['error'=>$validator->errors()]);
    }

    public function postLogout(Request $request) {
        Auth::guard('customer')->logout();
        Cart::destroy();
        return redirect()->back();
    }

    public function getForgotPassword(Request $request)
    {
        //Tạo token và gửi đường link reset vào email nếu email tồn tại
        if (Lang::locale() == 'vi'){
            $message=[
                'nhapemail' => 'Vui lòng nhập email đăng kí tài khoản của bạn',
                'xacnhanmk' => 'Xác nhận lấy lại mật khẩu',
                'mess-success' => 'Vui lòng kiểm tra email của bạn để xác nhận thay đổi mật khẩu',
                'mess-error' => 'Email không có trong hệ thống, vui lòng kiểm tra lại'
            ];
        }else{
            $message=[
                'nhapemail' => 'Please enter your account registration email',
                'xacnhanmk' => 'Confirm password recovery',
                'mess-success' => 'Please check your email to confirm password change',
                'mess-error' => 'Email is not in the system, please check'
            ];
        }
        if($request->email_reset ==''){            
            return response()->json([
                'status'=>2,
                'error_empty' => $message['nhapemail']
            ]);
        }
        $result = Member::where('email', $request->email_reset)->first();
        if($result){
            $resetPassword = ResetPassword::firstOrCreate(['email'=>$request->email_reset, 'token'=>Str::random(60)]);

            $token = ResetPassword::where('email', $request->email_reset)->first();

            $link = url('resetPassword')."/".$token->token; //send it to email

            $content_email = [
                'title' => $message['xacnhanmk'],
                'url' => $link,
            ];

            Mail::send('frontend.mail.mail-resetpassword', $content_email, function ($msg) use($request,$message) {
                $msg->from('no.reply.bot.gco@gmail.com', 'Website - KIDS SUN VIỆT NAM');
                $msg->to($request->email_reset, 'Website - KIDS SUN VIỆT NAM')->subject($message['xacnhanmk']);
            });
            return response()->json([
                'status'=>1,
                'message' => $message['mess-success']
            ]);
            
        } else {
            return response()->json([
                'status'=>0,
                'error' => $message['mess-error']
            ]);
        }
        
    }

    public function resetPassword($token)
    {
        $result = ResetPassword::where('token', $token)->first();

        if($result){
            return view('frontend.pages.new-password', compact('result'));
        } else {
            echo 'This link is expired';
        }
    }

    public function newPassword(Request $request)
    {
        if (Lang::locale() == 'vi'){
            $message=[
                'nhapmk' => 'Vui lòng nhập đầy đủ mật khẩu mới và nhập lại mật khẩu mới',
                'mess-success' => 'Thay đổi mật khẩu thành công',
                'mess-error' => 'Mật khẩu không khớp,vui lòng nhập lại'
            ];
        }else{
            $message=[
                'nhapmk' => 'Please enter your new password completely and re-enter your new password',
                'mess-success' => 'Password changed successfully',
                'mess-error' => 'Password does not match, please re-enter'
            ];
        }

        if($request->password == '' || $request->confirm==''){
            return redirect()->back()->with('error_empty',$message['nhapmk']);
        }
        if($request->password == $request->confirm){
            // Check email with token
            $result = ResetPassword::where('token', $request->token)->first();

            // Update new password 
            Member::where('email', $result->email)->update(['password'=>Hash::make($request->password)]);

            ResetPassword::where('token', $request->token)->delete();

            return redirect()->route('home.index')->with('success',$message['mess-success']);
        } else {
            return redirect()->back()->with('error',$message['mess-error']);
        }
    }

}
