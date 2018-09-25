<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class MstWeekTbl extends Model {
	//
	protected $table = 'mst_week_tbl';
	protected $primaryKey = 'week_id';
	public $timestamps = true;

	public function scopeClosedStoreWeek($query, $storeId) {

		$subQue = DB::raw("(SELECT week AS store_week FROM store_open_tbl WHERE store_id = {$storeId}) AS open");

		return $query->leftJoin($subQue, 'mst_week_tbl.week_id', '=', 'open.store_week')->whereNull('store_week');
	}

	public function scopeOpenStoreInfo($query, $storeId) {

		$sql =  "(	SELECT " .
				"		week AS store_week, " .
				"		start_time_hh AS s_hh, " .
				"		start_time_mm AS s_mm, " .
				"		end_time_hh AS e_hh, " .
				"		end_time_mm AS e_mm, " .
				"		accept_count" .
				"	FROM " .
				"		store_open_tbl " .
				"	WHERE " .
				"		store_id = {$storeId}" .
				") AS open";
		$subQue = DB::raw($sql);

		return $query->leftJoin($subQue, 'mst_week_tbl.week_id', '=', 'open.store_week');
	}


}