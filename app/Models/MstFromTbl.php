<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstFromTbl extends Model {
	//
	protected $table = 'mst_from_tbl';
	protected $primaryKey = 'from_id';
	public $timestamps = true;

}