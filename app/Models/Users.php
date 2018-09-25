<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Users extends Model {
	//
	protected $table = 'users';
	protected $primaryKey = 'id';
	public $timestamps = true;

	/**
	 * A user can have many messages
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function messages()
	{
	  return $this->hasMany(Message::class);
	}

}