<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveInfoView extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		DB::statement('DROP VIEW IF EXISTS reserve_info');
		$sql =  'CREATE VIEW reserve_info AS' .
				'    SELECT ' .
				'        reserve_tbl.reserve_id AS reserve_id,' .
				'        reserve_tbl.user_id AS user_id,' .
				'        store_info_tbl.store_name AS store_name,' .
				'        CONCAT(`reserve_tbl`.`reserve_date`,' .
				'                `reserve_tbl`.`reserve_hour`,' .
				'                `reserve_tbl`.`reserve_minu`) AS `date_time`,' .
				'        reserve_tbl.reserve_date AS resv_date,' .
				'        reserve_tbl.reserve_hour AS resv_hour,' .
				'        reserve_tbl.reserve_minu AS resv_minu,' .
				'        hos1.host_name AS fav_host_1,' .
				'        hos2.host_name AS fav_host_2,' .
				'        hos3.host_name AS fav_host_3,' .
				'        hos4.host_name AS fav_host_4,' .
				'        hos5.host_name AS fav_host_5,' .
				'        reserve_tbl.get_point AS get_point' .
				'    FROM' .
				'        ((((((reserve_tbl' .
				'        JOIN store_info_tbl ON ((reserve_tbl.store_id = store_info_tbl.store_id)))' .
				'        LEFT JOIN host_info_tbl hos1 ON ((reserve_tbl.fav_host_id_1 = hos1.id)))' .
				'        LEFT JOIN host_info_tbl hos2 ON ((reserve_tbl.fav_host_id_2 = hos2.id)))' .
				'        LEFT JOIN host_info_tbl hos3 ON ((reserve_tbl.fav_host_id_3 = hos3.id)))' .
				'        LEFT JOIN host_info_tbl hos4 ON ((reserve_tbl.fav_host_id_4 = hos4.id)))' .
				'        LEFT JOIN host_info_tbl hos5 ON ((reserve_tbl.fav_host_id_5 = hos5.id)))';
		DB::statement($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
		DB::statement( 'DROP VIEW IF EXISTS reserve_info' );
	}
}
