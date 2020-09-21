<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Options;
use App\Models\Recruitment;
use DateTime;
use SEO;
use SEOMeta;
use OpenGraph;
use App\Models\Menu;
use App\Models\Products;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Cart;

class ProductsController extends Controller
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

    public function listProducts(){
    	$data = Products::where('status',1)->paginate(6);
    	return view('frontend.pages.san-pham',compact('data'));
    }
    public function postAddCart(Request $request)
    {
        $idProduct   = $request->id_product;
        $dataProduct = Products::findOrFail($idProduct);
        $dataCart    = [
            'id'      => $dataProduct->id,
            'name'    => $dataProduct->name,
            'name_en'    => $dataProduct->name_en,
            'qty'     => $request->qty,
            'price'   => $request->price,
            'weight'  => 0,
            'options' => [
                'image'       => $dataProduct->image,
                'slug'        => $dataProduct->slug,
                'attributes'  => !empty($request->input('attributes')) ? $request->input('attributes') : null,
                'gift'        => !empty($request->gift) ? $request->gift : null,
                'choose_gift' => !empty($request->radiosale) ? $request->radiosale : null,
            ],
        ];
        Cart::add($dataCart);
        return back()->with(['toastr' => 'Thêm vào giỏ hàng thành công.']);
    }

    public function getAddCart(Request $request)
    {
        $idProduct   = $request->id;
        $dataProduct = Products::findOrFail($idProduct);
        $dataCart    = [
            'id'      => $dataProduct->id,
            'name'    => $dataProduct->name,
            
            'qty'     => 1,
            'price'   => $dataProduct->price,
            'weight'  => 0,
            'options' => [
                'image'       => $dataProduct->image,
                'slug'        => $dataProduct->slug,
                'name_en'    => $dataProduct->name_en,
            ],
        ];
        Cart::add($dataCart);
        return back()->with(['success' => 'Thêm vào giỏ hàng thành công.']);
    }

    public function gioHang(){
    	SEO::setTitle('Giỏ hàng');
    	//dd(Cart::content());
		return view('frontend.pages.product.gio-hang');
    }

    public function getUpdateCart(Request $request)
    {
        Cart::update($request->id, $request->qty);
        $item = Cart::get($request->id);
        $price_new = number_format($item->qty*$item->price, 0, '.', '.').' vnđ';
    	return response()->json([
                'price_new'=>$price_new,
                'total' => number_format(Cart::total(), 0, '.', '.').' vnđ',
                'count' => Cart::count()
        ]);
    }

    public function getRemoveCart(Request $request)
    {
        Cart::remove($request->id);
        $empty = '';
    	if (Lang::locale() == 'vi'){
    		$toastr = 'Xóa thành công sản phẩm ra khỏi giỏ hàng';
	        if(Cart::count() ==0){
	        	$empty = 'Không có sản phẩm nào trong giỏ hàng';
	        }
    	}else{
    		$toastr = 'Successfully removed the product from the cart';
    		if(Cart::count() ==0){
	        	$empty = 'Your shopping cart is empty';
	        }
    	}
        return response()->json([
                'toastr' => $toastr,
                'total' => number_format(Cart::total(), 0, '.', '.').' vnđ',
                'count' => Cart::count(),
                'empty' => $empty,
        ]);
        // return redirect()->back()->with([
        //     'toastr' => 'Xóa thành công sản phẩm ra khỏi giỏ hàng',
        // ]);
    }

    public function cartDestroy(){
    	Cart::destroy();
    	return back()->with(['success'=>'Xóa giỏ hàng thành công']);
    }
}
