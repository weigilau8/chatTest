<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfoTbl extends Model {
	//
	protected $table = 'user_info_tbl';
	protected $primaryKey = 'user_id';
	public $timestamps = true;

	/**
	 * 複数代入する属性
	 *
	 * @var array
	 */
	protected $fillable = ['user_id'];
	protected $dates = ['birth'];

}