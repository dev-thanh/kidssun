<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'locale'], function () {

    Route::get('change-language/{lang}', 'IndexController@getChangeLanguage')->name('home.change-language');

    Route::get('/', 'IndexController@getHome')->name('home.index');

    Route::get('/gioi-thieu', 'IndexController@getListAbout')->name('home.about');

    Route::get('/tuyen-dung/{slug}', 'IndexController@getSingleRecruitment')->name('home.single-recruitment');

    Route::get('/tuyen-dung', 'IndexController@getListRecruitment')->name('home.recruitment');

    Route::get('/tin-tuc', 'IndexController@getListNew')->name('home.news');

    Route::get('/tin-tuc/{slug}', 'IndexController@getSingleNews')->name('home.single-news');
    
    Route::get('/hinh-anh', 'IndexController@getListImage')->name('home.image');

    Route::get('/video', 'IndexController@getListVideo')->name('home.video');

    Route::get('/video/{slug}', 'IndexController@getSingleVideo')->name('home.single-video');

    Route::get('/lien-he', 'IndexController@getContact')->name('home.contact');

    Route::post('/lien-he', 'IndexController@postContact')->name('home.post-contact');

    Route::post('/tuyen-dung', 'IndexController@postRecruitment')->name('home.post-recruitment');

    Route::post('/dang-ky', 'IndexController@postMember')->name('home.post-member');

    Route::post('/dang-nhap', 'IndexController@postLogin')->name('home.post-login');

    Route::get('/logout', 'IndexController@postLogout')->name('home.logout');

    Route::post('/quen-mat-khau', 'IndexController@getForgotPassword')->name('home.quen-mat-khau');

    Route::get('/resetPassword/{token}', 'IndexController@resetPassword')->name('home.resetPassword');

    Route::post('/new-password', 'IndexController@newPassword')->name('home.new-password');

    /*  Quản lý tài khoản  */
    Route::group(['middleware' => 'customer_auth'], function () {
        // Đăng nhập thành công
        Route::get('/san-pham', 'ProductsController@listProducts')->name('home.list-products');

        Route::post('add-cart', 'ProductsController@postAddCart')->name('home.post-add-cart');

        Route::get('get-add-cart', 'ProductsController@getAddCart')->name('home.get-add-cart');

        Route::get('gio-hang', 'ProductsController@gioHang')->name('home.gio-hang');

        Route::get('update-giohang', 'ProductsController@getUpdateCart')->name('home.update-giohang');

        Route::get('remove-card', 'ProductsController@getRemoveCart')->name('home.remove-card');

        Route::get('destroy-card', 'ProductsController@cartDestroy')->name('home.destroy-card');
        /*  Quản lý tài khoản  */
        Route::get('thong-tin-tai-khoan', 'ManagerAccountController@thongTinTaiKhoan')->name('home.thong-tin-tai-khoan');

        Route::post('cap-nhap-tai-khoan', 'ManagerAccountController@postUpdateAccount')->name('home.cap-nhap-tai-khoan');

        Route::post('cap-nhap-mat-khau', 'ManagerAccountController@postUpdatePassword')->name('home.cap-nhap-mat-khau');

        Route::get('tai-khoan-ngan-hang', 'ManagerAccountController@bankAccount')->name('home.tai-khoan-ngan-hang');

        Route::post('cap-nhap-tai-khoan-ngan-hang', 'ManagerAccountController@postBankAccount')->name('home.cap-nhap-tai-khoan-ngan-hang');

        Route::get('nap-tien', 'ManagerAccountController@napTien')->name('home.nap-tien');

        Route::post('post-nap-tien', 'ManagerAccountController@postNapTien')->name('home.post-nap-tien');

        Route::get('lich-su-giao-dich', 'ManagerAccountController@TransactionHistory')->name('home.lich-su-giao-dich');

        Route::get('/export','ManagerAccountController@export_Lichsu_Giaodich')->name('home.export-giaodich');

        Route::get('/export','ManagerAccountController@export_Lichsu_Giaodich')->name('home.export-giaodich');

        Route::get('dat-hang','ManagerAccountController@datHang')->name('home.dat-hang');

        Route::get('lich-su-mua-hang','ManagerAccountController@lichSuMuaHang')->name('home.lich-su-mua-hang');

        Route::get('lich-su-mua-hang-dlcd','ManagerAccountController@lichSuMuaHangDaiLyCapDuoi')->name('home.lich-su-mua-hang-dlcd');

        Route::get('quan-ly-dai-ly','ManagerAccountController@quanLyDaiLy')->name('home.quan-ly-dai-ly');

        Route::get('chi-tiet-don-hang/{id}','ManagerAccountController@chiTietDonHang')->name('home.chi-tiet-don-hang');
        
    });

});


Route::group(['namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function () {
       	Route::get('/home', 'HomeController@index')->name('backend.home');

        Route::resource('users', 'UserController', ['except' => [
            'show'
        ]]);

        Route::resource('image', 'ImageController', ['except' => [
            'show'
        ]]);
        Route::post('image/postMultiDel', ['as' => 'image.postMultiDel', 'uses' => 'ImageController@deleteMuti']);

        // tuyển dụng
        Route::resource('recruitment', 'RecruitmentController', ['except' => ['show']]);
        Route::post('recruitment/postMultiDel', ['as' => 'recruitment.postMultiDel', 'uses' => 'RecruitmentController@deleteMuti']);
        Route::get('recruitment/get-slug', 'RecruitmentController@getAjaxSlug')->name('recruitment.get-slug');

        // Bài viết
        Route::resource('posts', 'PostController', ['except' => ['show']]);
        Route::post('posts/postMultiDel', ['as' => 'posts.postMultiDel', 'uses' => 'PostController@deleteMuti']);
        Route::get('posts/get-slug', 'PostController@getAjaxSlug')->name('posts.get-slug');

        // Ảnh
        Route::resource('picture', 'PictureController', ['except' => ['show']]);
        Route::post('picture/postMultiDel', ['as' => 'picture.postMultiDel', 'uses' => 'PictureController@deleteMuti']);

        // Video
        Route::resource('video', 'VideoController', ['except' => ['show']]);
        Route::post('video/postMultiDel', ['as' => 'video.postMultiDel', 'uses' => 'VideoController@deleteMuti']);
        Route::get('video/get-slug', 'VideoController@getAjaxSlug')->name('video.get-slug');

        /*Danh mục sản phẩm*/
        Route::resource('category', 'CategoriesController', ['except' => ['show']]);
        
        /*Danh sách sản phẩm*/
        Route::resource('products', 'ProductsController', ['except' => ['show']]);
        Route::post('products/postMultiDel', ['as' => 'products.postMultiDel', 'uses' => 'ProductsController@deleteMuti']);
        Route::get('products/get-slug', 'ProductsController@getAjaxSlug')->name('products.get-slug');

        /*  Quản lý doanh thu  */
        Route::resource('orders', 'OrdersController', ['except' => ['show']]);

        Route::get('xac-nhan-don-hang', 'OrdersController@xacNhanDonHang')->name('orders.xac-nhan');


        /*  Quản lý nạp tiền  */
        Route::resource('recharge', 'RechargeController', ['except' => ['show']]);
        Route::post('recharge/postMultiDel', ['as' => 'recharge.postMultiDel', 'uses' => 'RechargeController@deleteMuti']);
        Route::get('recharge/update-money', ['as' => 'recharge.update-money', 'uses' => 'RechargeController@update_Money']);
        Route::get('recharge/xac-nhan', ['as' => 'recharge.xac-nhan', 'uses' => 'RechargeController@xac_nhan_chuyen_tien']);

        /*  Quản lý thành viên  */
        Route::resource('member', 'MemberController', ['except' => ['show']]);
        Route::get('member/lock/{id}', 'MemberController@lockMember')->name('member.lock');
        Route::get('member/unlock/{id}', 'MemberController@unlocklockMember')->name('member.unlock');
        Route::get('member/filterdate', 'MemberController@filterDate')->name('member.filterdate');
        Route::get('member/rank', 'MemberController@rankMember')->name('member.rank');
        Route::get('member/rank/add', 'MemberController@addRankMember')->name('member.addrank');
        Route::post('member/rank/postadd', 'MemberController@postAddRankMember')->name('member.postaddrank');
        Route::get('member/detail/{id}', 'MemberController@member_Detail')->name('member.detail');

        Route::get('chi-tiet-don-hang/{id}','MemberController@chiTietDonHang')->name('home.chi-tiet-don-hang');

        // Đơn ứng tuyển
        Route::group(['prefix' => 'apply-job'], function() {
            Route::get('/', ['as' => 'get.list.job', 'uses' => 'ApplyJobController@getList']);
            Route::get('edit/{id}', ['as' => 'get.edit.job', 'uses' => 'ApplyJobController@getEdit']);
            Route::post('edit/{id}', ['as' => 'post.edit.job', 'uses' => 'ApplyJobController@postEdit']);
            Route::post('/delete-muti', ['as' => 'apply-job.postMultiDel', 'uses' => 'ApplyJobController@postDeleteMuti']);
            Route::delete('{id}/delete', ['as' => 'apply-job.destroy', 'uses' => 'ApplyJobController@getDelete']);
        });

        // Liên hệ
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', ['as' => 'get.list.contact', 'uses' => 'ContactController@getListContact']);
            Route::post('/delete-muti', ['as' => 'contact.postMultiDel', 'uses' => 'ContactController@postDeleteMuti']);
            Route::get('{id}/edit', ['as' => 'contact.edit', 'uses' => 'ContactController@getEdit']);
            Route::post('{id}/edit', ['as' => 'contact.post', 'uses' => 'ContactController@postEdit']);
            Route::delete('{id}/delete', ['as' => 'contact.destroy', 'uses' => 'ContactController@getDelete']);
        });

        Route::group(['prefix' => 'pages'], function() {
            Route::get('/', ['as' => 'pages.list', 'uses' => 'PagesController@getListPages']);
            Route::get('build', ['as' => 'pages.build', 'uses' => 'PagesController@getBuildPages']);
            Route::post('build', ['as' => 'pages.build.post', 'uses' => 'PagesController@postBuildPages']);
            Route::post('/create', ['as' => 'pages.create', 'uses' => 'PagesController@postCreatePages']);
        });

        Route::group(['prefix' => 'options'], function() {
            Route::get('/general', 'SettingController@getGeneralConfig')->name('backend.options.general');
            Route::post('/general', 'SettingController@postGeneralConfig')->name('backend.options.general.post');

            Route::get('/developer-config', 'SettingController@getDeveloperConfig')->name('backend.options.developer-config');
            Route::post('/developer-config', 'SettingController@postDeveloperConfig')->name('backend.options.developer-config.post');
        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', ['as' => 'setting.menu', 'uses' => 'MenuController@getListMenu']);
            Route::get('edit/{id}', ['as' => 'backend.config.menu.edit', 'uses' => 'MenuController@getEditMenu']);
            Route::post('add-item/{id}', ['as' => 'setting.menu.addItem', 'uses' => 'MenuController@postAddItem']);
            Route::post('update', ['as' => 'setting.menu.update', 'uses' => 'MenuController@postUpdateMenu']);
            Route::get('delete/{id}', ['as' => 'setting.menu.delete', 'uses' => 'MenuController@getDelete']);
            Route::get('edit-item/{id}', ['as' => 'setting.menu.geteditItem', 'uses' => 'MenuController@getEditItem']);
            Route::post('edit', ['as' => 'setting.menu.editItem', 'uses' => 'MenuController@postEditItem']);
        });

       Route::get('/get-layout', 'HomeController@getLayOut')->name('get.layout');


    });
});

Auth::routes(
    [
        'register' => false,
        'verify' => false,
        'reset' => false,
    ]
);
