<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfoTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('user_info_tbl', function (Blueprint $table) {
			$table->integer('user_id')->unique();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('from_id');
			$table->foreign('from_id')->references('from_id')->on('mst_from_tbl');
			$table->string('tel', 15);
			$table->string('line', 255)->nullable();
			$table->date('birth');
			$table->timestamps();
			$table->primary('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('user_info_tbl');
	}
}
