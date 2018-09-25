<?php

namespace App\Http\Controllers;

use App\Models\StoreHostInfo;
use App\Models\StoreInfoTbl;
use App\Models\MstFromTbl;
use function array_push;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function var_dump;

class ListController extends Controller {

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function list(Request $request, $page = 0) {
		// ページチェック
		if ($page == 0) {
			$request->session()->forget('storeImages');
			$page = 1;
		}

		// 店舗写真一覧
		$images = $request->session()->get('storeImages', function () {
			$findImgs = array();
			$stores = StoreInfoTbl::select(['store_id', 'store_name'])->distinct()->get();
			foreach ($stores as $store) {
				$imgFiles = \File::glob('storage/images/Store/Store_1_' . $store->store_id . '.jpg');

				foreach ($imgFiles as $img) {
					$findImgs[] = ['store_id' => $store->store_id, 'store_name' => $store->store_name, 'img_src' => '/' . $img];
				}
			}

			session(['storeImages' => $findImgs]);

			return $findImgs;

		});


		// ページアンカー
		$pgNavi = array();

		if (!empty($images)) {
			$pgCnt = (int)(count($images) / config('const.MAX_PAGE'));
			if (count($images) % config('const.MAX_PAGE') !== 0) {
				$pgCnt++;
			}

			if($page != 1){
				$pgNavi[] = '<a href="/list/1">&laquo; 最初へ</a>';
			}

			for ($i = 1; $i <= $pgCnt; $i++) {
				if ($i == $page) {
					$pgNavi[] = '<span class="current">' . $i . '</span>';
				} else {
					$pgNavi[] = '<a href="/list/' . $i . '">' . $i . '</a>';
				}
			}

			if ($pgCnt != $page) {
				$pgNavi[] = '<a href="/list/' . ($page + 1) . '">次へ &raquo;</a>';
				$pgNavi[] = '<a href="/list/' . $pgCnt . '">最後へ &raquo;</a>';
			}
		}

		// ページイメージ
		$partImgs = array();
		$firstIdx = ($page - 1) * config('const.MAX_PAGE');
		$lastIdx = $page * config('const.MAX_PAGE');

		foreach ($images as $key => $img) {
			if ($firstIdx <= $key && $key < $lastIdx) {
				$partImgs[] = $img;
			}
		}

		// FROMマスタ
		$froms = MstFromTbl::all();

		//var_dump($images);
		return view('list', compact('partImgs', 'froms', 'pgNavi'));
	}

	public function findStore(Request $request) {

//		dd($request->keyword);
//		echo('-------');
//		return;

		// 料金・年齢範囲
		$priceRange = explode(';', $request->input('price_range'));
		$ageRange = explode(';', $request->input('age_range'));

		$stores = StoreHostInfo::priceRange($priceRange)->ageRange($ageRange);

		// キーワード
		$keyword = $request->input('keyword');
		if ($keyword !== null) {
			$stores = $stores->storeName($keyword);
		}

		// エリア
		$area = $request->input('area');
		if ($area !== null) {
			$stores = $stores->area($area);
		}

		// 新着店舗
		if ($request->has('new')) {
			// 三か月以内
			$threeMonAgo = Carbon::now()->subMonth(3);
			$stores = $stores->newArrival($threeMonAgo);
		}

		$storeInfo = $stores->select(['store_id', 'store_name'])->distinct()->get();


		$images = array();
		foreach ($storeInfo as $store) {
			// 店舗写真一覧
			$imgFiles = \File::glob('storage/images/Store/Store_1_' . $store->store_id . '.jpg');

			foreach ($imgFiles as $img) {
				$images[] = ['store_id' => $store->store_id, 'store_name' => $store->store_name, 'img_src' => '/' . $img];
			}
		}

		//var_dump($images);
		$request->session()->put('storeImages', $images);

		return redirect('/list/1')->withInput();
	}
}
