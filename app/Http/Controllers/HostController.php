<?php

namespace App\Http\Controllers;

use App\Models\MstFromTbl;
use App\Models\MstNominateTbl;
use App\Models\MstDialectTbl;
use App\Models\MstHistoryTbl;
use App\Models\MstSalesTbl;
use App\Models\MstVisualTbl;
use App\Models\StoreHostInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function var_dump;

class HostController extends Controller {

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function host(Request $request, $page = 0) {
		// ページチェック
		if ($page == 0) {
			$request->session()->forget('hostImages');
			$page = 1;
		}

		// ホスト写真一覧
		$images = $request->session()->get('hostImages', function () {
			$findImgs = array();
			$hosts = StoreHostInfo::select(['store_id', 'host_id', 'store_name', 'host_name'])->distinct()->get();

			foreach ($hosts as $host) {
				$imgFiles = \File::glob('storage/images/Host/Host_' . $host->host_id . '_main.jpg');
				$imgFilesS = \File::glob('storage/images/Host/Host_' . $host->host_id . '_Small_*.jpg');

				foreach ($imgFiles as $img) {
					$findImgs[] = ['store_id' => $host->store_id, 'host_id' => $host->host_id,
                        'store_name' => $host->store_name, 'host_name' => $host->host_name,
                        'img_src' => '/' . $img, 'sImgs_src' => $imgFilesS];
				}
			}

			session(['hostImages' => $findImgs]);
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
				$pgNavi[] = '<a href="/host/1">&laquo; 最初へ</a>';
			}

			for ($i = 1; $i <= $pgCnt; $i++) {
				if ($i == $page) {
					$pgNavi[] = '<span class="current">' . $i . '</span>';
				} else {
					$pgNavi[] = '<a href="/host/' . $i . '">' . $i . '</a>';
				}
			}

			if ($pgCnt != $page) {
				$pgNavi[] = '<a href="/host/' . ($page + 1) . '">次へ &raquo;</a>';
				$pgNavi[] = '<a href="/host/' . $pgCnt . '">最後へ &raquo;</a>';
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

		$mst = array();

		// エリア・出身地マスタ
		$mst['mst_from'] = MstFromTbl::all();
		// 指名本数マスタ
		$mst['mst_nomi'] = MstNominateTbl::all();
		// 売上マスタ
		$mst['mst_sales'] = MstSalesTbl::all();
		// ホスト歴マスタ
		$mst['mst_hist'] = MstHistoryTbl::all();
		// 見た目マスタ
		$mst['mst_visual'] = MstVisualTbl::all();
		// 方言マスタ
		$mst['mst_diale'] = MstDialectTbl::all();

		return view('host', compact('partImgs', 'pgNavi', 'mst'));
	}

	public function findHost(Request $request) {
		// 料金・年齢範囲
		$priceRange = explode(';', $request->input('price_range'));
		$ageRange = explode(';', $request->input('age_range'));

		$hosts = StoreHostInfo::priceRange($priceRange)->ageRange($ageRange);

		// キーワード
		$keyword = $request->input('keyword');
		if ($keyword !== null) {
			$hosts = $hosts->hostName($keyword);
		}

		// エリア
		$area = $request->input('area');
		if ($area !== null) {
			$hosts = $hosts->area($area);
		}

		// 出身地
		$from = $request->input('from');
		if ($from !== null) {
			$hosts = $hosts->fromId($from);
		}

		// 指名本数
		$nominate = $request->input('nominate');
		if ($nominate !== null) {
			$hosts = $hosts->nominateCountId($nominate);
		}

		// 売り上げ
		$sales = $request->input('sales');
		if ($sales !== null) {
			$hosts = $hosts->salesId($sales);
		}

		// ホスト歴
		$hist = $request->input('history');
		if ($hist !== null) {
			$hosts = $hosts->historyId($hist);
		}

		// 見た目の系統
		$visual = $request->input('visual');
		if ($visual !== null) {
			$hosts = $hosts->visualId($visual);
		}

		// 方言
		$dialect = $request->input('dialect');
		if ($dialect !== null) {
			$hosts = $hosts->dialectId($dialect);
		}

		// 新着店舗
		if ($request->has('new')) {
			$threeMonAgo = Carbon::now()->subMonth(3);
			$hosts = $hosts->newArrival($threeMonAgo);
		}

		$hostInfo = $hosts->select(['store_id', 'host_id', 'store_name', 'host_name'])->distinct()->get();

		$images = array();
		foreach ($hostInfo as $host) {
			// ホスト写真一覧
			$imgFiles = \File::glob('storage/images/Host/*_' . $host->host_id . '_main.jpg');
            $imgFilesS = \File::glob('storage/images/Host/Host_' . $host->host_id . '_Small_*.jpg');

            foreach ($imgFiles as $img) {
                $images[] = ['store_id' => $host->store_id, 'host_id' => $host->host_id,
                    'store_name' => $host->store_name, 'host_name' => $host->host_name,
                    'img_src' => '/' . $img, 'sImgs_src' => $imgFilesS];
            }
		}

		//var_dump($images);
		$request->session()->put('hostImages', $images);

		return redirect('/host/1')->withInput();
	}

}
