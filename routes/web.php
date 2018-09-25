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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// HOSMATCHの使い方
Route::get('/about', 'AboutController@about');

// 会員登録/ログイン
//Route::get('/login', 'LoginController@login');

// 登録店舗
Route::get('/list/{page?}', 'ListController@list');
Route::post('/list/find_store', 'ListController@findStore');

// 登録ホスト
Route::get('/host/{page?}', 'HostController@host');
Route::post('/host/find_host', 'HostController@findHost');

// 即ホスト
Route::get('/soon_host/{page?}', 'SoonHostController@host');
Route::post('/soon_host/find_host', 'SoonHostController@findHost');

// テンプレート(お問い合わせ?、名称要検討)
Route::get('/template', 'TemplateController@template');

// 店舗詳細
Route::get('/detail/{storeId?}/{hostId?}', 'DetailController@detail');
Route::post('/detail/reserve', 'DetailController@reserve');
Route::post('/detail/chk_reserve', 'DetailController@chkReserve');
Route::post('/detail/set_favrite', 'DetailController@setFavorite');

// マイページ
Route::get('/mypage', 'MyPageController@myPage');
Route::get('/mypage_top', 'MyPageTopController@myPageTop');
Route::get('/mypage_user', 'MyPageUserController@myPageUser');
Route::post('/mypage_user/update', 'MyPageUserController@update');
Route::get('/mypage_rireki', 'MyPageRirekiController@myPageRireki');
Route::post('/mypage_rireki/cancel/{resrveId?}', 'MyPageRirekiController@cancelReserv');
Route::get('/mypage_fav', 'MyPageFavController@myPageFav');

// googlemap for test
Route::get('/gmap', 'GmapController@gmap');

//ajax
Route::post('/ajax/getPickUp','AjaxController@getPickUp')->name('getPickUp');

Route::get('/chat', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');