<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreAdmin;
use App\Models\StoreInfoTbl;
use App\Models\Common\ReserveInfo;
use App\Models\Common\ReserveTbl;
use App\Models\Common\PointSetting;
use function array_push;
use function is_null;
use function strlen;
use function substr;
use function var_dump;

class MyPageRirekiController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the reservation history.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function myPageRireki() {
		// これからの予約
		$resvYet = ReserveInfo::reserveYet(\Auth::id())->get();
		$reservYet = array();

		foreach ($resvYet as $resv) {
			$datetime = substr($resv->resv_date, 0, 4) . '/'
					. substr($resv->resv_date, 4, 2) . '/'
					. substr($resv->resv_date, 6, 2) . ' '
					. $resv->resv_hour . ':' . $resv->resv_minu;

			$hosts = is_null($resv->fav_host_1) === false ? '<li>' . $resv->fav_host_1 . '</li>' : '';
			$hosts .= is_null($resv->fav_host_2) === false ? '<li>' . $resv->fav_host_2 . '</li>' : '';
			$hosts .= is_null($resv->fav_host_3) === false ? '<li>' . $resv->fav_host_3 . '</li>' : '';
			$hosts .= is_null($resv->fav_host_4) === false ? '<li>' . $resv->fav_host_4 . '</li>' : '';
			$hosts .= is_null($resv->fav_host_5) === false ? '<li>' . $resv->fav_host_5 . '</li>' : '';

			if (strlen($hosts) === 0) {
				$hosts = 'ナシ';
			}
			$reservYet[] = ['id' => $resv->reserve_id, 'date_time' => $datetime, 'store' => $resv->store_name,
					'hosts' => $hosts, 'status' => $resv->resv_status, 'conf' => $resv->confirm_num];
		}

		$yetNavi = '';
		$cnt = $resvYet->count();
		if ($cnt) {
			$yetNavi .= '<span class="navi_yet current" name="navi_yet" id="pg_yet_top">&laquo; 最初へ</span>';

			$page = (int)($cnt / 5);
			$page += $cnt % 5 === 0 ? 0 : 1;

			for ($i = 1; $i <= $page; $i++) {
				$id = sprintf('%02d', $i);
				$yetNavi .= '<span class="navi_yet num' . ($i === 1 ? ' current' : '') . '" name="navi_yet" id="pg_yet_' . $id . '">' . $i . '</span>';
			}
			$yetNavi .= '<span class="navi_yet' . ($cnt <= 5 ? ' current' : '') . '" name="navi_yet" id="pg_yet_next">次へ &raquo;</span>';
			$yetNavi .= '<span class="navi_yet' . ($cnt <= 5 ? ' current' : '') . '" name="navi_yet" id="pg_yet_last">最後へ &raquo;</span>';
			$yetNavi .= '<input type="hidden" id="yet_count" value="' . sprintf('%02d', $page) . '">';
		}

		// 来店済み予約
		$resvFin = ReserveInfo::reserveFinish(\Auth::id())->get();
		$reservFin = array();

		foreach ($resvFin as $resv) {
			$datetime = substr($resv->resv_date, 0, 4) . '/'
					. substr($resv->resv_date, 4, 2) . '/'
					. substr($resv->resv_date, 6, 2) . ' '
					. $resv->resv_hour . ':' . $resv->resv_minu;

			$hosts = is_null($resv->fav_host_1) === false ? '<li>' . $resv->fav_host_1 . '</li>' : '';
			$hosts .= is_null($resv->fav_host_2) === false ? '<li>' . $resv->fav_host_2 . '</li>' : '';
			$hosts .= is_null($resv->fav_host_3) === false ? '<li>' . $resv->fav_host_3 . '</li>' : '';
			$hosts .= is_null($resv->fav_host_4) === false ? '<li>' . $resv->fav_host_4 . '</li>' : '';
			$hosts .= is_null($resv->fav_host_5) === false ? '<li>' . $resv->fav_host_5 . '</li>' : '';

			if (strlen($hosts) === 0) {
				$hosts = 'ナシ';
			}

			$reservFin[] = ['date_time' => $datetime, 'store' => $resv->store_name, 'hosts' => $hosts, 'point' => $resv->get_point];
		}

		$finNavi = '';
		$cnt = $resvFin->count();
		if ($cnt) {
			$finNavi .= '<span class="navi_fin current" name="navi_fin" id="pg_fin_top">&laquo; 最初へ</span>';

			$page = (int)($cnt / 5);
			$page += $cnt === 0 ? 0 : 1;

			for ($i = 1; $i <= $page; $i++) {
				$id = sprintf('%02d', $i);
				$finNavi .= '<span class="navi_fin num' . ($i === 1 ? ' current' : '') . '" name="navi_fin" id="pg_fin_' . $id . '">' . $i . '</span>';
			}
			$finNavi .= '<span class="navi_fin' . ($cnt <= 5 ? ' current' : '') . '" name="navi_fin" id="pg_fin_next">次へ &raquo;</span>';
			$finNavi .= '<span class="navi_fin' . ($cnt <= 5 ? ' current' : '') . '" name="navi_fin" id="pg_fin_last">最後へ &raquo;</span>';
			$finNavi .= '<input type="hidden" id="fin_count" value="' . sprintf('%02d', $page) . '">';
		}

		return view('mypage_rireki', compact('reservYet', 'yetNavi', 'reservFin', 'finNavi'));
	}

	public function cancelReserv(Request $request, $reservId) {

		// キャンセルポイント
		$can_point = PointSetting::find(config('Common.point.cancel_point'))->point;

		$reserv = ReserveTbl::find($reservId);
		$store = StoreInfoTbl::find($reserv->store_id);

		$store_admin = StoreAdmin::find($store->store_admin_id);
		$store_admin->point = $store_admin->point + $can_point;
		$store_admin->save();

		$reserv->reserve_status = 2; // キャンセルステータス
		$reserv->save();

		return redirect('/mypage_rireki');
	}
}