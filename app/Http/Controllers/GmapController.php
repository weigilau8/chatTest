<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GmapController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
/*	public function __construct() {
		$this->middleware('auth');
	}*/

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function gmap() {
		return view('gmap');
	}
}
