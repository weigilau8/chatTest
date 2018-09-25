<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteInfo extends Model {
	//
	protected $table = 'favorite_info';
	protected $primaryKey = 'id';
	public $timestamps = false;
}