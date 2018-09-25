<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreHostInfoView extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		DB::statement('DROP VIEW IF EXISTS store_host_info');
		$sql = 'CREATE VIEW store_host_info AS' .
				'    SELECT ' .
				'        store_info_tbl.store_id AS store_id,' .
				'        store_info_tbl.store_name AS store_name,' .
				'        store_info_tbl.store_address AS store_address,' .
				'        store_info_tbl.initial_price AS initial_price,' .
				'        store_info_tbl.created_at AS created_at,' .
				'        host_info_tbl.id AS host_id,' .
				'        host_info_tbl.host_name AS host_name,' .
				'        TIMESTAMPDIFF(YEAR, host_info_tbl.birth, NOW()) AS age,' .
				'        host_info_tbl.from_id AS from_id,' .
				'        host_info_tbl.nominate_count_id AS nominate_count_id,' .
				'        host_info_tbl.sales_id AS sales_id,' .
				'        host_info_tbl.history_id AS history_id,' .
				'        host_info_tbl.visual_id AS visual_id,' .
				'        host_info_tbl.dialect_id AS dialect_id,' .
				'        store_info_tbl.soon_time AS store_soon,' .
				'        host_info_tbl.soon_time AS host_soon' .
				'    FROM' .
				'        (store_info_tbl' .
				'        JOIN host_info_tbl ON ((store_info_tbl.store_id = host_info_tbl.store_id)))';
		DB::statement($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
		DB::statement( 'DROP VIEW IF EXISTS store_host_info' );
	}
}
