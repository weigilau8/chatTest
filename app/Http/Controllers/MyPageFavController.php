<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteInfo;

class MyPageFavController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function myPageFav() {
		// ホスト写真一覧
		$favImgs = array();
		$hosts = FavoriteInfo::where('user_id', \Auth::id())->get();

		foreach ($hosts as $host) {
			$imgFiles = \File::glob('storage/images/Host/Host_' . $host->host_id . '_main.jpg');
			$imgFilesS = \File::glob('storage/images/Host/Host_' . $host->host_id . '_Small_*.jpg');

			foreach ($imgFiles as $img) {
				$favImgs[] = ['store_id' => $host->store_id, 'host_id' => $host->host_id,
						'store_name' => $host->store_name, 'host_name' => $host->host_name,
						'img_src' => '/' . $img, 'sImgs_src' => $imgFilesS];
			}
		}

//		var_dump($favImgs);
//		return;

		return view('mypage_fav', compact('favImgs'));
	}
}
