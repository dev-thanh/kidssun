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

});


Route::group(['namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function () {
       	Route::get('/home', 'HomeController@index')->name('backend.home');

        Route::resource('users', 'UserController', ['except' => [
            'show'
        ]]);

        Route::resource('images', 'ImageController', ['except' => [
            'show'
        ]]);
        Route::post('images/postMultiDel', ['as' => 'images.postMultiDel', 'uses' => 'ImageController@deleteMuti']);

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
