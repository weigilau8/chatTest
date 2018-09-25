<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteHost extends Model {
	//
	protected $table = 'favorite_host';
	public $timestamps = false;

	/**
	 * 複数代入する属性
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'store_id', 'host_id'];

}