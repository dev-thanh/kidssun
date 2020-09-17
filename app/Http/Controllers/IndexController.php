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
use Illuminate\Support\Facades\Mail;
use App\Models\Image;
use App\Models\Customer;
use App\Models\Posts;
use App\Models\Picture;
use App\Models\Video;
use App\Models\Contact;
use App\Models\ApplyJob;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\RecruitmentRequest;
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

}
