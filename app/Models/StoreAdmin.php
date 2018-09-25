<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreAdmin extends Model {
	//
	protected $table = 'store_admin';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $fillable = ['point'];

}