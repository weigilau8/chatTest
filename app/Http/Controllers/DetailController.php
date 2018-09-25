<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Utils\CalenderUtil;
use App\Models\HostInfoTbl;
use App\Models\StoreInfoTbl;
use App\Models\MstWeekTbl;
use App\Models\StoreAdmin;
use App\Models\FavoriteHost;
use App\Models\Common\PointSetting;
use App\Models\Common\ReserveTbl;

use function is_null;
use function sprintf;
use function var_dump;

class DetailController extends Controller {

	/**
	 * Show the detail page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function detail(Request $request, $storeId = 0, $hostId = 0) {

		// 店舗情報
		$request->session()->put('storeId', $storeId);
		$store = StoreInfoTbl::find($storeId);
		// 定休日
		$closed = MstWeekTbl::closedStoreWeek($storeId)->get()->implode('week', '・');

		// 店内写真
		$images = array();
		$imgFiles = \File::glob('storage/images/Store/*_' . $store->store_id . '.jpg');
		foreach ($imgFiles as $img) {
			$images[] = ['store_id' => $store->store_id, 'store_name' => $store->store_name, 'img_src' => '/' . $img];
		}
		$imgs['store'] = $images;

		// No5
		$no5 = array();
		$imgFiles = \File::glob('storage/images/Staff/*_' . $store->store_id . '.jpg');
		foreach ($imgFiles as $img) {
			$no5[] = ['store_id' => $store->store_id, 'store_name' => $store->store_name, 'img_src' => '/' . $img];
		}
		$imgs['no5'] = $no5;

		// 全ホスト
		$imgHosts = array();
		$hosts = HostInfoTbl::where('store_id', $storeId)->get();
		// お気に入りホスト
		$favHosts = FavoriteHost::where([['user_id', \Auth::id()], ['store_id', $storeId]])->get();

		foreach ($hosts as $host) {
			$imgFiles = \File::glob('storage/images/Host/Host_' . $host->id . '_main.jpg');

			foreach ($imgFiles as $img) {
				$fav = $favHosts->where('host_id', $host->id)->count() !== 0 ? 'checked' : '';
				$imgHosts[] = ['host_id' => $host->id, 'host_name' => $host->host_name, 'img_src' => '/' . $img, 'fav' => $fav];
			}
		}
		$imgs['hosts'] = $imgHosts;

		// ForTest
		//Carbon::setTestNow(Carbon::create(2018, 7, 10, 0, 0, 0));

		// 祝日
		$s_dt = Carbon::today();
		$e_dt = $s_dt->copy()->addDay(14);
//		$s_dt->month(1)->day(1);
//		$e_dt->month(12)->day(31);

		$holi = CalenderUtil::getGoogleHoliday($s_dt, $e_dt);

//		echo($s_dt);
//		echo($e_dt);
//		var_dump($holi);
//		return;

		// TODO:曜日の持ち方を検討
		$weekCnv = [6, 0, 1, 2, 3, 4, 5, 7];

		$weeksCls = ['sunday', '', '', '', '', '', 'saturday', 'sunday'];
		$weeksDsp = ['(日)', '(月)', '(火)', '(水)', '(木)', '(金)', '(土)', '(祝)'];

		$dt_now = Carbon::now();
		$dt = Carbon::today();
		$dateInfo['month'] = $dt->month . '月';

		// 予約時間帯
		$dayInfo = array();
		$hourInfo = array();
		for ($i = 0; $i < 14; $i++) {
			$s_dt = $dt->copy();
			$e_dt = $dt->copy();

			$dow = $dt->dayOfWeek;
			if (array_key_exists($dt->format('Y-m-d'), $holi)) {
				$dow = 7;
			}

			$dayInfo[$i] = ['day' => $dt->day . '日', 'cls' => $weeksCls[$dow], 'dsp' => $weeksDsp[$dow]];

			// 営業時間情報
			$openWeek = MstWeekTbl::openStoreInfo($storeId)->where('week_id', $weekCnv[$dow]);
			$bOpen = !is_null($openWeek->value('store_week'));

//			echo($openWeek->value('s_hh') . ':' . $openWeek->value('s_mm'));
//			echo($openWeek->value('e_hh') . ':' . $openWeek->value('e_mm'));
//			echo($bOpen);
//			echo('</br>');

			if ($bOpen) {
				$s_dt->hour($openWeek->value('s_hh'))->minute($openWeek->value('s_mm'));

				if ($openWeek->value('e_hh') == '24') {
					$e_dt->addDay()->hour(0)->minute($openWeek->value('e_mm'));
				} else {
					$e_dt->hour($openWeek->value('e_hh'))->minute($openWeek->value('e_mm'));
				}
			}

			$dif_dt = $dt->copy();
			for ($j = 2; $j <= 49; $j++) {
				$h = (int)($j / 2);
				$m = ($j % 2 == 0) ? 0 : 30;

				$dt_id = sprintf('%4d_%02d_%02d_%02d_%02d', $dt->year, $dt->month, $dt->day, $h, $m);

				$cls = 'ng';
				$val = '×';
				if ($bOpen) {
					if ($j == 48) {
						$dif_dt->addDay();
					}

					if ($dif_dt->hour(($h == 24) ? 0 : $h)->minute($m)->between($s_dt, $e_dt)) {
						if ($i == 0 && $dif_dt->lt($dt_now)) {
							//$hourInfo[sprintf('%02d', $j)][] = ['cls' => 'ng', 'dt_id' => $dt_id, 'val' => '×'];
						} else {
							$cls = 'ok';
							$val = '◎';
							//$hourInfo[sprintf('%02d', $j)][] = ['cls' => 'ok', 'dt_id' => $dt_id, 'val' => '◎'];
						}
					}
//					echo($s_dt . '_');
//					echo($e_dt . '_');
//					echo($dif_dt);
//					echo('</br>');
				}
				$hourInfo[sprintf('%02d:%02d', $h, $m)][] = ['cls' => $cls, 'dt_id' => $dt_id, 'val' => $val];
			}

			$dt->addDay();
		}

		$dateInfo['days'] = $dayInfo;
		$dateInfo['hours'] = $hourInfo;

		return view('detail', compact('store', 'closed', 'imgs', 'dateInfo', 'hostId', 'storeId'));
	}

	/**
	 * host reservation.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function reserve(Request $request) {

		$storeId = $request->session()->pull('storeId');
		if ($storeId==null){
			$storeId = $request->storeId;
		}
		$userId = \Auth::id();
		$resDate = explode('_', $request->res_date);

		// 予約確認番号
		$conf = random_int(100000, 999999);
		while (true) {
			if (ReserveTbl::chkConfNum($storeId, $conf)) {
				break;
			}
			$conf = random_int(100000, 999999);
		}

		$res = new ReserveTbl;
		$res->store_id = $storeId;
		$res->user_id = $userId;
		$res->reserve_date = $resDate[0] . $resDate[1] . $resDate[2];
		$res->reserve_hour = $resDate[3];
		$res->reserve_minu = $resDate[4];
		$res->fav_host_id_1 = strlen($request->fav_host_1) === 0 ? null : $request->fav_host_1;
		$res->fav_host_id_2 = strlen($request->fav_host_2) === 0 ? null : $request->fav_host_2;
		$res->fav_host_id_3 = strlen($request->fav_host_3) === 0 ? null : $request->fav_host_3;
		$res->fav_host_id_4 = strlen($request->fav_host_4) === 0 ? null : $request->fav_host_4;
		$res->fav_host_id_5 = strlen($request->fav_host_5) === 0 ? null : $request->fav_host_5;
		$res->first_flg = ReserveTbl::isFirst($storeId, $userId);
		$res->confirm_num = $conf;
		$res->save();

		// ToDo ポイントLOG
		// 予約ポイント
		$rsv_point = PointSetting::find(config('Common.point.reserv_point'))->point;

		// 店舗管理者ポイント消化
		$admin_id = StoreInfoTbl::find($storeId)->store_admin_id;
		$store_admin = StoreAdmin::find($admin_id);
		$store_admin->point = $store_admin->point + $rsv_point;
		$store_admin->save();

		return redirect('/mypage_rireki');
	}

	/**
	 * check reservation date.
	 *
	 * @return String
	 */
	public function chkReserve(Request $request) {

		$resv = ReserveTbl::isEnable(\Auth::id(), $_POST['res_date'])->first();
		if (is_null($resv)) {
			return 'OK';
		}

		return StoreInfoTbl::where('store_id', $resv->store_id)->first()->store_name;
	}

	/**
	 * Setting Favorite host
	 *
	 * @return
	 */
	public function setFavorite(Request $request) {

		$userId = \Auth::id();
		$storeId = $request->session()->get('storeId');
		$hostId = $_POST['host_id'];

		if ($_POST['add_flg'] === 'true') {
			// お気に入りに追加
			$fav = new FavoriteHost;
			$fav->user_id = $userId;
			$fav->store_id = $storeId;
			$fav->host_id = $hostId;
			$fav->save();

		} else {
			// お気に入りから削除
			$fav = FavoriteHost::where([['user_id', $userId], ['store_id', $storeId], ['host_id', $hostId]]);
			$fav->first()->delete();

		}

		return $_POST['add_flg'];
	}
}