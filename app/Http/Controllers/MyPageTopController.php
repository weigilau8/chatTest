<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPageTopController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function myPageTop() {
		return view('mypage_top');
	}
}
