<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreHostInfo extends Model {
	//
	protected $table = 'store_host_info';
	protected $primaryKey = 'host_id';
	public $timestamps = true;

	public function scopePriceRange($query, $range) {
		return $query->whereBetween('initial_price', $range);
	}

	public function scopeAgeRange($query, $range) {
		return $query->whereBetween('age', $range);
	}

	public function scopeStoreName($query, $key) {
		return $query->where('store_name', 'like', '%' . $key . '%');
	}

	public function scopeHostName($query, $key) {
		return $query->where('host_name', 'like', '%' . $key . '%');
	}

	public function scopeArea($query, $area) {
		return $query->where('store_address', 'like', '%' . $area . '%');
	}

	public function scopeNewArrival($query, $threeMonAgo) {
		return $query->where('created_at', '>', $threeMonAgo);
	}

	public function scopeFromId($query, $fromId) {
		return $query->where('from_id', $fromId);
	}

	public function scopeNominateCountId($query, $nominamteId) {
		return $query->where('nominate_count_id', $nominamteId);
	}

	public function scopeSalesId($query, $salesId) {
		return $query->where('sales_id', $salesId);
	}

	public function scopeHistoryId($query, $histId) {
		return $query->where('history_id', $histId);
	}

	public function scopeVisualId($query, $visId) {
		return $query->where('visual_id', $visId);
	}

	public function scopeDialectId($query, $dialId) {
		return $query->where('dialect_id', $dialId);
	}

	public function scopeSoonHost($query, $now) {
		// 現在時刻から一時間前
		$now->subHour(1);
		return $query->where('store_soon', 1)->where('host_soon', '>', $now);
	}
}