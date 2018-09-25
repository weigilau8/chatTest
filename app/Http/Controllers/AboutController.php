<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller {

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function about() {
		return view('about');
	}
}
