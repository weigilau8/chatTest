<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('reserve_tbl', function (Blueprint $table) {
			$table->increments('reserve_id');
			$table->integer('store_id');
			$table->foreign('store_id')->references('store_id')->on('store_info_tbl');
			$table->integer('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('reserve_date', 8);
			$table->string('reserve_hour', 2);
			$table->string('reserve_minu', 2);
			$table->integer('fav_host_id_1')->nullable();
			$table->foreign('fav_host_id_1')->references('host_id')->on('host_info_tbl');
			$table->integer('fav_host_id_2')->nullable();
			$table->foreign('fav_host_id_2')->references('host_id')->on('host_info_tbl');
			$table->integer('fav_host_id_3')->nullable();
			$table->foreign('fav_host_id_3')->references('host_id')->on('host_info_tbl');
			$table->integer('fav_host_id_4')->nullable();
			$table->foreign('fav_host_id_4')->references('host_id')->on('host_info_tbl');
			$table->integer('fav_host_id_5')->nullable();
			$table->foreign('fav_host_id_5')->references('host_id')->on('host_info_tbl');
			$table->tinyInteger('reserve_status')->default(0);
			$table->tinyInteger('first_flg');
			$table->integer('get_point')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('reserve_tbl');
	}
}
